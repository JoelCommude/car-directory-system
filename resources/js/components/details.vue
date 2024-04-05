<template>
    <v-dialog v-model="detailDialog" max-width="500" persistent>
        <v-card>
            <v-toolbar color="#8c57ff" flat dense dark >
                <v-toolbar-title class="text-h6" style="background-color: #8c57ff" dark>OWNER DETAILS</v-toolbar-title>
                    <v-spacer></v-spacer>
                <v-btn icon @click="mCloseDialog()">
                    <v-icon dense>mdi-close</v-icon>
                </v-btn>
            </v-toolbar>
            <v-form v-model="isFormValid">
            <v-card-text class="d-flex mb-n6">
                <v-avatar rounded="lg" size="100" class="me-6 mt-4">
                    <v-img :src="`images/${sex}.png`"></v-img>
                </v-avatar>
                <v-row>
                    <v-col cols="6" class="mt-4">
                        <v-text-field v-if="detailDialog == true" :rules="rules" v-model="firstName" label="First Name" outlined dense :disabled="roleID == 2"></v-text-field>
                    </v-col>
                    <v-col cols="6" class="mt-4">
                        <v-text-field v-if="detailDialog == true" :rules="rules" v-model="lastName" label="Last Name" outlined dense :disabled="roleID == 2"></v-text-field>
                    </v-col>
                    <v-col cols="12" class="mt-n8">
                        <v-text-field v-if="detailDialog == true" v-model="ownerDetails.register_date" label="Register Date" outlined dense disabled></v-text-field>
                    </v-col>
                </v-row>
            </v-card-text>
            <v-divider/>
            <v-card-text>
                <v-form class="mt-6">
                    <v-row>
                        <v-col cols="12" class="mb-n6">
                            <v-text-field v-if="detailDialog == true && roleID == 1" v-model="ownerDetails.users.username" label="Username" outlined dense disabled></v-text-field>
                        </v-col>
                        <v-col cols="12" class="mb-n6">
                            <v-text-field v-if="detailDialog == true" v-model="carName" label="Car Name" outlined dense disabled></v-text-field>
                        </v-col>
                        <v-col cols="6" class="mb-n6">
                            <v-text-field v-if="detailDialog == true" v-model="ownerDetails.plate_number" label="Plate Number" outlined dense disabled></v-text-field>
                        </v-col>
                        <v-col cols="6" class="mb-n6">
                            <v-text-field v-if="detailDialog == true" v-model="ownerDetails.engine_number" label="Engine Number" outlined dense disabled></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field v-if="detailDialog == true" v-model="ownerDetails.fuel.name" label="Fuel" outlined dense disabled></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field v-if="detailDialog == true" v-model="ownerDetails.body.name" label="Body Type" outlined dense disabled></v-text-field>
                        </v-col>
                    </v-row>
                </v-form>
            </v-card-text>
            <v-card-actions v-if="roleID == 1" class="mt-n6">
                <v-checkbox v-model="checkboxDelete" label="disuse"></v-checkbox>
                <v-spacer/>
                <v-btn :disabled="!isFormValid" @click="mUpdate()">Update</v-btn>
            </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>
<script>
export default {
    props:{
        detailDialog:{
            type: Boolean
        },
        ownerDetails:{
            type: Object
        },
        roleID:{
            type: null
        },
    },
    data(){
        return{
            firstName:'',
            lastName:'',
            carName:'',
            username:'',
            password:'',
            checkboxDelete:false,
            rules:[v => !!v || 'Required.'],
            isFormValid:false,
            sex:''
        }
    },
    watch:{
        detailDialog(){
            this.firstName = this.ownerDetails.users.first_name
            this.lastName = this.ownerDetails.users.last_name
            this.carName = this.ownerDetails.company.name + ' ' + this.ownerDetails.car.name
            this.username = this.ownerDetails.users.username
            this.sex = this.ownerDetails.users.sex == 1 ? 'male' : 'female'
        }
    },
    methods:{
        mCloseDialog(){
            this.$emit("closeDialog", false)
        },

        mUpdate(){
            axios.put('api/user/{user}',{
                UserID:this.ownerDetails.user_id,
                FirstName:this.firstName,
                LastName:this.lastName,
                Delete:this.checkboxDelete
            })
            .then(res =>{
                if(res.data == 'Success'){
                    this.mCloseDialog();
                }
            })
        },
    }
}
</script>
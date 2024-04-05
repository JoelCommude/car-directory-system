<template>
    <v-dialog v-model="changePassDialog" max-width="500" persistent>
         <v-card>
            <v-toolbar color="#8c57ff" flat dense dark >
                <v-toolbar-title class="text-h6" style="background-color: #8c57ff" dark>Change Password</v-toolbar-title>
                    <v-spacer></v-spacer>
                <v-btn icon @click="mCloseDialog()">
                    <v-icon dense>mdi-close</v-icon>
                </v-btn>
            </v-toolbar>
        
            <v-card-text class="pt-10" style="background-color: white">
                <!-- For Adding data -->
                <template>
                    <v-text-field :disabled="clickId == 2" class="mb-n4" solo dense v-model="userName"
                        :rules="userRules" @blur="mCheckUserName()">
                        <label slot="prepend" class="text-left justify-center" style="font-size: 13px">
                        *Input User Name:&nbsp;&nbsp;&nbsp;&nbsp;
                        </label>
                    </v-text-field>
                    <br/>
                    <v-text-field v-if="changePassDialog == true" solo dense v-model="newPassword" :append-icon="showNewpassword ? 'mdi-eye' : 'mdi-eye-off'" 
                        :rules="rules"
                        :type="showNewpassword ? 'text' : 'password'"
                        @click:append="showNewpassword = !showNewpassword">
                        <label slot="prepend" class="text-left justify-center" style="font-size: 13px">
                            *Input New Password:
                        </label>
                    </v-text-field>
                </template>
            </v-card-text>

            <v-card-actions>
            <template >
                <v-spacer></v-spacer>
                <v-btn :disabled="this.newPassword.length <= 0 || userExists == false" @click="mUpdate()" color="#B0BEC5"><b>Update</b> </v-btn>
            </template>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
export default {
    props:{
        changePassDialog:{
            type: Boolean
        },
        username:{
            type: String
        },
        clickId:{
            type: null
        }
    },
    data(){
        return{
            userName:'',
            newPassword:'',
            showNewpassword:false,
            rules:[v => !!v || 'Required.'],
            userRules:[],
            userExists:false,
        }
    },
    watch:{
        changePassDialog(){
            if(this.clickId == 2){
                this.userName = this.username
            }
        }
    },
    methods:{
        mCloseDialog(){
            this.userName = ''
            this.newPassword = ''
            this.userRules = []
            this.$emit("closeDialog", false)
        },

        mCheckUserName(){
            this.userRules = []
            axios.get(`api/user/${this.userName}`)
            .then(res =>{
                if(res.data.length > 0){
                    this.userExists = true
                }
                else{
                    this.userExists = false
                    this.userRules = [
                        v => !!v || 'Required',
                        v => v && this.userExists == true || 'Username already exists'
                    ]
                }
            })
        },

        mUpdate(){
            axios.get(`api/user/${this.clickId == 1 ? this.userName : this.username}/edit`,{
                params:{
                    password:this.newPassword
                }
            })
            .then(res =>{
                if(res.data == 'Success'){
                    this.mSuccessMessage();
                    this.mCloseDialog();
                }
            })
        },

        mSuccessMessage(){
            const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-right",
                showConfirmButton: false,
                type: "success",
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", this.$swal.stopTimer)
                    toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: "success",
                iconColor: "#4CAF50",
                title:"Success!"
            })
        },
    }
}
</script>
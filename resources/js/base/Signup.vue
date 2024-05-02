<template>
    <v-dialog v-model="signupDialog" max-width="500" persistent>
        <v-card>
            <v-form v-model="isFormValid">
            <v-toolbar color="#8c57ff" flat dense dark >
                <v-toolbar-title class="text-h6" style="background-color: #8c57ff" dark>ADD USER</v-toolbar-title>
                    <v-spacer></v-spacer>
                <v-btn icon @click="mCloseDialog()">
                    <v-icon dense>mdi-close</v-icon>
                </v-btn>
            </v-toolbar>
            <v-card-text>
                <v-row>
                    <v-col cols="12">
                        <v-text-field class="mt-4 mb-n6" v-model="userName" label="Username" placeholder="Johndoe" dense outlined @blur="mCheckUserName" :rules="userRules" ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field class="mb-n6" v-model="password" label="Password" placeholder="············" dense outlined type="password" :rules="rules" @blur="mRules(password)"></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field class="mb-n6" v-model="firstName" label="First Name" placeholder="John" dense outlined :rules="rules"></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field class="mb-n6" v-model="lastName" label="Last Name" placeholder="Doe" dense outlined :rules="rules"></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-select class="mb-n6" v-model="sexId" :items="sex" item-text="name" item-value="id" label="Sex" dense outlined :rules="rules"></v-select>
                    </v-col>
                    <v-col cols="12">
                        <v-select class="mb-n6" v-model="roleId" :items="roles" item-text="name" item-value="id" label="Role" dense outlined :rules="rules"></v-select>
                    </v-col>    
                    <v-col cols="12">
                        <v-select class="mb-n6" v-model="companyId" :items="companies" item-text="name" item-value="id" label="Company" dense outlined @change="mCar()"></v-select>
                    </v-col>
                    <v-col cols="12">
                        <v-select class="mb-n6" v-model="carId" :items="cars" item-text="name" item-value="id" label="Car" dense outlined :rules="transactionRules"></v-select>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field class="mb-n6" v-model="plateNumber" label="Plate Number" placeholder="TEST1234" dense outlined :rules="transactionRules"></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field class="mb-n6" v-model="engineNumber" label="Engine Number" placeholder="123456" dense outlined :rules="transactionRules"></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-select class="mb-n6" v-model="bodyId" :items="bodies" item-text="name" item-value="id" label="Bodies" dense outlined :rules="transactionRules"></v-select>
                    </v-col>
                    <v-col cols="6">
                        <v-select class="mb-n6" v-model="fuelTypeId" :items="fuelTypes" item-text="name" item-value="id" label="Fuel Type" dense outlined :rules="transactionRules"></v-select>
                    </v-col>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <!-- <v-spacer/> -->
                <v-btn :disabled="!isFormValid" @click="mSubmit()" color="#B0BEC5" block><b>Submit</b> </v-btn>
            </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>
<script>
export default {
    props:{
        signupDialog:{
            type: Boolean
        },
        companies:{
            type: Array
        },
    },
    data(){
        return{
            userName:'',
            password:'',
            firstName:'',
            lastName:'',
            sexId:null,
            roleId:null,
            companyId:null,
            carId:null,
            plateNumber:'',
            engineNumber:'',
            bodyId:null,
            fuelTypeId:null,
            sex:[
                {id:1, name:"Male"},
                {id:2, name:"Female"},
            ],
            roles:[
                {id:1, name:"Admin"},
                {id:2, name:"Car Owner"},
            ],
            cars:[],
            bodies:[],
            fuelTypes:[],
            user:'',
            userExists:false,
            rules: [],
            userRules:[],
            transactionRules:[],
            isFormValid:false
        }
    },
    created(){
        this.user = this.$store.state.UserLog
        this.mFuel()
        this.mBody()
    },
    methods:{
        mCloseDialog(){
            this.mClear()
            this.$emit("closeDialog", false)
        },

        mSubmit(){
            axios.post('api/user',
            {
                username:this.userName,
                password:this.password,
                first_name:this.firstName,
                last_name:this.lastName,
                sex:this.sexId,
                role_id:this.roleId,
                company_id:this.companyId,
                car_id:this.carId,
                plate_number:this.plateNumber,
                engine_number:this.engineNumber,
                body_id:this.bodyId,
                fuel_id:this.fuelTypeId,
                updated_by: this.user
            }).then(res =>{
                if(res.data == 'Success'){
                    this.mSuccessMessage()
                    this.mCloseDialog()
                }
            }).catch((err) =>{
                // console.log(err.response.statusText)
                this.mErrorMessage(err.response.statusText + 'Person')
            })
        },
        mClear(){
            this.userName= '',
            this.password= '',
            this.firstName= '',
            this.lastName= '',
            this.sexId= null,
            this.roleId= null,
            this.companyId= null,
            this.carId= null,
            this.plateNumber= '',
            this.engineNumber= '',
            this.bodyId= null,
            this.fuelTypeId= null
            this.rules = []
            this.userRules = []
            this.transactionRules = []
        },

        mErrorMessage(message){
            const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-left",
                showConfirmButton: false,
                type: "error",
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", this.$swal.stopTimer)
                    toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: "error",
                iconColor: "#FF0000",
                title:message
            })
        },

        mSuccessMessage(){
            const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-left",
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

        mCar(){
            this.transactionRules = [ v => !!v || 'Required.',]
            axios.get('api/car',{
                params:{
                    id:this.companyId
                }
            })
            .then(res => {
                this.cars = res.data.data
            })
        },

        mFuel(){
            axios.get('api/fuel')
            .then(res => {
                this.fuelTypes = res.data.data
            })
        },

        mBody(){
            axios.get('api/bodytype')
            .then(res => {
                this.bodies = res.data.data
            })
        },

        mRules(val){
            this.rules = [v => !!v || 'Required.',]
        },

        mCheckUserName(){
            this.userRules = []
            axios.get(`api/user/${this.userName}`)
            .then(res =>{
                if(res.data.length > 0){
                    this.userExists = true
                    this.userRules = [
                        v => v && this.userExists != true || 'Username already exists'
                    ]
                }
                else{
                    this.userExists = false
                    if(this.userName == ''){
                        this.userRules = [
                            v => !!v || 'Required'
                        ]
                    }
                }
            })
        },

        mTransactionRules(){

        },
    },
    computed:{

    },
}
</script>
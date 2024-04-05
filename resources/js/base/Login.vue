<template>
    <div class="login">
        <v-card class="auth-card pa-4 pt-7" max-width="500">
            <v-card-title class="font-weight-semibold text-2xl text-uppercase d-flex justify-center"><v-icon class="pr-2 pb-2" size="30px" color="#8c57ff">mdi-car</v-icon>CAR OWNER DIRECTORY</v-card-title>
            <v-card-text class="pt-2">
                <h6 class="text-h6 font-weight-semibold mb-1">
                    Welcome to COD! 👋🏻
                </h6>
                <p class="mb-0">
                    Please sign-in to your account and start the adventure
                </p>
                <v-text-field 
                    class="pt-6" 
                    v-model="userName" 
                    label="User" 
                    dense 
                    outlined 
                    :rules="[rules.required]" 
                    @keyup.enter="mNextFocus()" 
                    clearable>
                </v-text-field>
                <v-text-field 
                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'" 
                    :rules="[rules.required]" 
                    :type="showPassword ? 'text' : 'password'"
                    v-model="password" 
                    label="Password" 
                    dense 
                    outlined 
                    ref='passwordInput' 
                    @keyup.enter='mLogin()' 
                    @click:append="showPassword = !showPassword" class="mb-n2"
                >
                </v-text-field>
                <div>
                    <a @click="changePassDialog = true" class="ms-2" style="color: #8c57ff;">Forgot Password?</a>
                </div>
                <v-btn color="#8c57ff" elevation="2" class="mt-4" block @click="mLogin()">Login</v-btn>
            </v-card-text>
            <Account :changePassDialog="changePassDialog" :username="userName" :clickId="1" @closeDialog="changePassDialog = false"></Account>
        </v-card>
    </div>
</template>
<script>
import Account from '../components/changepassword'
export default {
    components:{Account,},
    data(){
        return{
            showPassword:false,
            userName:'',
            password:'',
            signUpDialog:false,
            loading:false,
            rules: {
                required: value => !!value || 'Required.',
            },
            loader:null,
            changePassDialog:false,
        }
    },
    methods:{
        mNextFocus(){
            this.$refs.passwordInput.focus()
        },
        mLogin(){
            if(this.userName == '' || this.password == ''){
                this.mErrorMessage("Input User Name or Password!")
            }else{
                axios.post('api/login',{
                   UserName:this.userName,
                   Password:this.password
                }).then(res =>{
                    if(res.data.data != undefined){
                        this.$store.commit("userLog",{value:res.data.data[0]['username']})
                        this.$store.commit("data",{value:res.data.data})
                        window.location.href  ='/home'
                    }
                    else{
                        this.mErrorMessage("Invalid username and password!")
                    }
                })
                .catch(error=>{
                    console.log(error)
                })
            }
        },

        mCloseSignupDialog(){
            this.signUpDialog = false
        },

        mErrorMessage(message){
            const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-right",
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
    }
}
</script>
<style scoped>
    .login {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;     
    }
    ::v-deep .v-btn__content {
        color: white;
    }
</style>

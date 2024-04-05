<template>
    <v-app>
        <div>
            <Navbar v-if="this.$store.state.UserLog !=''"></Navbar>
            <Login v-else></Login>
        </div>
    </v-app>
</template>
<script>
import Login from '../base/Login';
import Navbar from '../base/Navbar';
export default {
    components:{Login,Navbar},
    data(){
        return{

        }
    }
}
</script>
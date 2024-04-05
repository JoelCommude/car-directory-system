<template>
    <v-app id="inspire">
        <v-navigation-drawer app clipped>
            <v-list dense>
                <v-list-item v-for="(item,i) in items" :key="i" :to="item.to">
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>{{ item.text }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar app clipped-left>
            <v-toolbar-title><v-icon color="#8c57ff" class="pr-2 pb-2" size="30px">mdi-car</v-icon>CAR OWNER DIRECTORY</v-toolbar-title>
            <v-spacer/>
            <v-menu offset-y>
                <template v-slot:activator="{ on, attrs }">
                    <v-avatar v-bind="attrs" v-on="on">
                        <v-img :src="`images/${sex}.png`"></v-img>
                    </v-avatar>
                </template>
                <v-list>
                    <v-list-item
                        v-for="(item, i) in settings"
                        :key="i"
                        @click="mClick(i)"
                        :to="item.to"
                        link
                        style='text-decoration: none;'
                    >
                        <v-list-item-title >{{ item.title }}</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>
        <v-main class="ma-2">
            <router-view></router-view>
        </v-main>
        <Account :changePassDialog="changePassDialog" :username="username" :clickId="2" @closeDialog="changePassDialog = false"></Account>
    </v-app>
</template>
<script>
import Account from '../components/changepassword'
export default {
    components:{Account,},
    data(){
        return{
            drawer:null,
            items:[
                {text:'Home', icon:'mdi-home', to:'home'},
                // {text:'Companies', icon:'mdi-office-building', to:'company'},
                // {text:'Cars', icon:'mdi-car', to:'car'},
                // {text:'Fuels', icon:'mdi-fuel', to:'fuel'},
                // {text:'Bodies', icon:'mdi-car-back', to:'body'},
                // {text:'Accounts', icon:'mdi-account', to:'account'},
            ],
            settings:[
                { title: 'Change Password',to:null },
                { title: 'Logout',to:'/' },
            ],
            changePassDialog:false,
            username:'',
            sex:''
        }
    },
    created(){
        this.sex = this.$store.state.Datas[0]['sex'] == 1 ? 'male' : 'female'
        this.username = this.$store.state.Datas[0]['username']
    },
    methods:{
        mClick(i){
            if(i == 1){
                this.$store.commit("userLog",{value:''})
                this.$store.commit("data",{value:[]})
                window.location.href  ='/login'
            }
            else{
                this.changePassDialog = true
            }
        },
    },
}
</script>
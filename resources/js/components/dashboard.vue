<template>
    <v-card>
        <v-btn class="font-weight-bold mb-0 mt-4 " style="font-size:14px;margin-left:1%;" @click="mClear()" plain v-if="adminID == 1">CLEAR</v-btn>
        <v-row dense style="margin-left:2%;margin-right:1%;" justify="center" v-if="adminID == 1">
            <v-col v-for="company in companies" :key="company.id">
                <v-card tile elevation="3" height="40" class='text-center' :color='company.color'>
                    <v-row no-gutters>
                        <v-col cols="4">
                            <v-icon style="margin-top:10%" color='white' size='25' @click="mGetDatas(company.id)">mdi-car</v-icon>
                        </v-col>
                        <v-col cols="8">
                            <!-- this is where the dashboard filter show -->
                            <v-card height="37" style='margin-right:1.5%;margin-top:1.5%;font-size:10px' class='text-center' tile elevation='0' color='white'>
                                <span>{{company.name.toUpperCase() }}</span><br>
                                <h4>{{company.CountedData}}</h4>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-card>
            </v-col>
        </v-row>
        <v-row class="pt-6">
            <v-col cols="2">
                <v-text-field v-model="search" class="ml-10" label="SEARCH" hint="Name,Car,Plate Number,Engine Number" dense outlined style="width: 300px;"></v-text-field>
            </v-col>
            <v-col cols="1">
                <v-btn class="ml-10" @click="mGetDatas()">Search</v-btn>
            </v-col>
            <v-spacer/>
            <v-tooltip bottom v-if="adminID == 1">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn 
                    class="mr-10 mt-3"
                    v-bind="attrs"
                    v-on="on" @click="signUpDialog = true">
                    <v-icon>mdi-plus</v-icon>
                    </v-btn>
                </template>
                <span> Add Users</span>
            </v-tooltip>
        </v-row>
        <v-card-text>
            <v-simple-table fixed-header>
                <thead>
                    <tr>
                        <th class="text-uppercase">Name</th>
                        <th class="text-uppercase">Car</th>
                        <th class="text-uppercase">Plate Number</th>
                        <th class="text-uppercase">Engine Number</th>
                        <th class="text-uppercase">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data,i) in datas" :key="i">
                        <td>{{ data.users.first_name + ' ' + data.users.last_name}}</td>
                        <td>{{ data.company.name + ' ' + data.car.name}}</td>
                        <td>{{ data.plate_number }}</td>
                        <td>{{ data.engine_number }}</td>
                        <td><v-btn @click="mOpenOwner(i)"><v-icon>mdi-eye</v-icon></v-btn></td>
                    </tr>
                </tbody>
            </v-simple-table>
        </v-card-text>
        <Signup :signupDialog="signUpDialog" :companies="companies" @closeDialog="mCloseDialog()"></Signup>
        <Detail :detailDialog="detailDialog" :ownerDetails="ownerDetails" :roleID="adminID" @closeDialog="mCloseDialog()"></Detail>
    </v-card>
</template>
<script>
import Signup from '../base/Signup'
import Detail from './details'
export default {
    components:{Signup,Detail,},
    data(){
        return{
            companies: [],
            signUpDialog:false,
            search:'',
            datas:[],
            adminID:null,
            detailDialog:false,
            ownerDetails:{},
            userId:null,
        }
    },
    created(){
        this.adminID = this.$store.state.Datas[0]['role_id']
        this.userId = this.$store.state.Datas[0]['id']
        this.mGetCompany()
        this.mGetDatas()
    },
    methods:{
        mClear(){
            this.search = ''
            this.mGetDatas()
        },
        mGetCompany(){
            axios.get('api/company',{
                params:{
                    roleID: this.adminID,
                    userID: this.userId,
                }
            })
            .then(res => {
                this.companies = res.data.data;
            })
        },
        mGetDatas(id){
            axios.get('api/transaction',{
                params:{
                    search: this.search,
                    company: id,
                    roleID: this.adminID,
                    userID: this.userId,
                }
            })
            .then(res => {
                this.datas = res.data.data
            })
        },
        mOpenOwner(index){
            this.detailDialog = true
            this.ownerDetails = this.datas[index];
        },

        mCloseDialog(){
            this.signUpDialog = false
            this.detailDialog = false
            this.mGetDatas()
        }
    },
}
</script>
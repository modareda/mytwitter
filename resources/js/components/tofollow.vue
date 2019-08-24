<template>
    <div>
        <div class="d-flex justify-content-between" v-for="(user, index) in sugFollow" :key="index">
            <div>
                <img src="images/img_avatar3.png" class="img-fluid mr-2 img" alt="Cinque Terre">
                <a :href="'/profile/'+user.id">
                <span>{{user.name}}</span>
                <span class="text-muted small d-block" style="padding-left: 38px;">@{{user.username}}</span>
                </a>
            </div>
            <div>
                <follow :tofollow="user" :ifollow="following"></follow>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        following:{},
    },
    data(){
        return{
            sugFollow:{}
        }
    },
    methods:{
        getToFollow(){
            axios.post('/tofollow')
            .then(({data}) => {
                this.sugFollow = data;
            })
        }
    },
    mounted(){
        this.getToFollow();
    }
}
</script>
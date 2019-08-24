<template>
<div>
    <div class="btn btn-outline-primary btn-sm pointer" @click="unfollow" v-if="iFollowThisUser(tofollow.id)">Unfollow</div>
    <div class="btn btn-outline-primary btn-sm pointer" @click="follow" v-else >Follow</div>
</div>
    
</template>
<script>
export default {
    props:{
        tofollow:{},
        ifollow:{}
    },
    data(){
        return {
            iamfollowing:this.ifollow,
        }
    },
    methods:{
        follow(){
            axios.post(`/follow/${this.tofollow.id}`)
            .then((data)=>{
                this.iamfollowing.push(this.tofollow)
            });
        },
        unfollow(){
            axios.post(`/unfollow/${this.tofollow.id}`)
            .then(()=>{
                this.iamfollowing.splice(this.tofollow, 1);
            });
        },
        iFollowThisUser(userID){
            return !!(this.iamfollowing.find(user =>user.id == userID));
        }
    },

}
</script>
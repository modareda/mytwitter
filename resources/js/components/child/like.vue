<template>
<div>
    <div class="p-2 pointer" @click='like'  :class="{'text-danger' : iLiked}">
        <i class="fas fa-heart"></i> 
        <span class="p-2 pointer">{{post.likes.length}}</span>        
    </div>
    
</div>
</template>
<script>
export default {
    props:{
        post:{},
        me:{},
        postlikes:{}
    },
    data(){
        return {
            likes:this.postlikes
        }
    },
    methods:{
        like(){
            axios.post(`/post/${this.post.id}/like`)
            .then(({data})=>{
                console.log(data);
                if(data){
                    this.likes.push(data);
                } else [
                    this.likes.splice(this.myLiked, 1)
                ]
            });
        },
        
    },
    computed:{
        myLiked(){
            return this.likes.find(liker=> liker.user_id == this.me.id);
        },
        iLiked(){
            return !!this.myLiked;
        }
    }

}
</script>
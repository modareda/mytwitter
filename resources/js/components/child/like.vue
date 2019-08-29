<template>
<div>
    <div class="p-2 pointer" @click='toggle'  :class="{'text-danger' : loved}">
        <i class="fas fa-heart"></i> 
        <span class="p-2 pointer">{{likesCount}}</span>        
    </div>
    
</div>
</template>
<script>
export default {
    props:{
        post:{},
        me:{},
    },
    data(){
        return {
            likesCount: this.post.likescount,
            loved: this.post.isLiked,
        }
    },
    methods:{
        toggle(){
            this.loved ? this.unlike() : this.like()
        },
        like(){
            axios.post(`/post/${this.post.id}/like`)
            .then(()=>{
                // console.log(data);
                // if(data){
                //     this.likes.push(data);
                // } else [
                //     this.likes.splice(this.myLiked, 1)
                // ]
                this.likesCount++;
                this.loved = true;
            });
        },
        unlike(){
            axios.delete(`/post/${this.post.id}/like`)
            .then(()=>{
                this.likesCount--;
                this.loved = false;
            });
        },
    },

}
</script>
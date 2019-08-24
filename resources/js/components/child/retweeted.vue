<template>
    <a class="d-block" style="cursor: pointer; width:96%">

        <div class='retweeted p-2'>
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img src="/images/img_avatar3.png" class="img-fluid mr-2 smallimg" alt="Cinque Terre">
                        <a :href="'/profile/'+retweeted.user.id">{{retweeted.user.name}} <span class="text-muted small">@{{retweeted.user.username}}</span></a> 
                    </div>
                </div>
            </div>

            <div class="card-body">
                <p class="card-text text-break">{{retweeted.body}}</p>
            </div>
        </div>

    </a>
</template>
<script>
export default {
    props:['postId'],
    data(){
        return{
            retweeted:{}
        }
    },
    methods:{
        showthepost(){
            axios.post(`/post/${this.postId}`)
            .then(({data})=>{
                this.retweeted = data
            });
        },
    },
    created(){
        this.showthepost()
    }
}
</script>
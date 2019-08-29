<template>
    <a class="d-block" style="cursor: pointer; width:96%">

        <div class='retweeted p-2'>
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img src="/images/img_avatar3.png" class="img-fluid mr-2 smallimg" alt="Cinque Terre">
                        <a :href="'/profile/'+user.id">{{user.name}} <span class="text-muted small">@{{user.username}}</span></a> 
                    </div>
                </div>
            </div>

            <div class="card-body">
                <p class="card-text text-break">{{retweetedBody}}</p>
            </div>
        </div>

    </a>
</template>
<script>
export default {
    props:['postId'],
    data(){
        return{
            retweetedBody:'',
            user:{}
        }
    },
    methods:{
        showthepost(){
            axios.post(`/post/${this.postId}`)
            .then(({data})=>{
                this.retweetedBody = data.body;
                this.user = data.user
            });
        },
    },
    created(){
        this.showthepost()
    }
}
</script>
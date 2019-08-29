<template>
    <div>
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <img src="/images/img_avatar3.png" class="img-fluid mr-2 img" alt="Cinque Terre">
                    <a :href="'/profile/'+post.user.id">{{post.user.name}} <span class="text-muted small">@{{post.user.username}}</span></a> 
                </div>
                <div>
                <ul class="navbar-nav mr-3">
                    <li class="nav-item dropdown">
                            <a id="navbarDropdown" href='' class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:black"><span class="caret"></span></a>

                            <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href=''>View post</a>
                                <a class="dropdown-item" href='' @click.prevent="deletemyPost(post.id)" v-if="myPost(post.user_id)">Delete</a>
                            </div>
                        </li>
                </ul>
                </div>
            </div>
        </div>
        <div class="card-body" v-if="!post.post_id">
            <p class="card-text text-break">{{post.body}}</p>
            <div class="d-flex justify-content-start" style="margin-left: -50px;">
                <like :me='user' :post="post"></like>
                <span class="p-2 pointer" @click="sharepost(post.id)"><i class="fas fa-retweet"></i></span>
                <comment :maincomments="post.comments" :post="post"></comment>
            </div>
        </div>
        <div class="card-body" v-else>
            <retweeted :postId='post.post_id'></retweeted>
        </div>
    </div>
</template>
<script>
    import like from "./child/like";
    import comment from './child/comment'
    import retweeted from './child/retweeted'
export default {
    props:['post', 'user'],
    components:{
        like,
        comment,
        retweeted
    },
    methods:{
        sharepost(postId){
            axios.post(`/home`,{body: 'Null',postid: postId})
            .then(({data})=>{
                // this.posts = {
                //     ...this.posts,
                //     data:[
                //         data,
                //         ...this.posts.data
                //     ]
                // }
                this.$parent.$emit('retweet', data);
            });
        },
        deletemyPost(postId){
            if(confirm('Are you sure you wanna delete ?')){
                axios.delete(`/home/${postId}`)
                .then(()=>{
                    // this.posts.data.splice(index, 1)
                    $(this.$el).fadeOut(50);
                });
            }
        },
        myPost(postUserId){
            return this.user.id == postUserId;
        }
    },
}
</script>
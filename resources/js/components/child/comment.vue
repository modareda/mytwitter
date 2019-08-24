<template>
<div>
    <div class="p-2 pointer"  @click='show = !show'><i class="far fa-comment"></i></div>
    <div class="row mt-2 mb-3" style="margin-left: -50px;margin-bottom: 20px;" v-if="show">
            <div class="col col-md-9">
                <textarea v-model="comment" style="resize: none" rows="1" class="form-control borderRound" placeholder="Reply..."></textarea>
            </div>
            <div class="col col-md-2">
                <div class="pointer">
                    <button class="text-muted btn" @click="addComment"><strong>Reply</strong></button>
                </div>
            </div>
    </div>
    <div  v-if="show" class="d-block" style='margin-left: -100px;padding: 6px 0 5px 13px;'>
        <div v-for="(comment, index) in comments.data" :key="index">
            <img src="/images/img_avatar3.png" class="img-fluid mr-2 img" alt="Cinque Terre">
            <div class="d-inline-block">
                <h5>{{comment.user.name}}</h5>
            </div>

            <div class="d-block ml-4" style="background-color: #f2f3f5; border-radius: 50px;width: 75%;">
                <p class="text-muted p-2 pl-3 mb-1">{{comment.comment}}</p>
            </div>
            
        </div>
    </div>

</div>
</template>

<script>
export default {
    props:{
        maincomments:{},
        post:{}
    },
    data(){
        return{
            show: false,
            comments: {
                data:this.maincomments
            },
            comment:''
        }
    },
    methods:{
        addComment(){
            if(!this.comment){return;}
            axios.post(`/post/${this.post.id}/comment`, {comment: this.comment})
            .then(({data}) => {
                console.log(data);
                this.comments = {
                    ...this.comments,
                    data: [
                        ...this.comments.data,
                        data
                    ]
                }
            });
            this.comment = ''
        }
    }
}
</script>
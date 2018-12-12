<template>
    <div>
        <button class="btn btn-primary small pull-right" @click.prevent="blockUser()">
            {{ blockStatus }}
        </button>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                componentBlock: ''
            }
        },
        props: ['userId', 'block'],
        created() {
          this.componentBlock = this.block;  //////  пропсы нельзя считать
        },
        computed: {
            blockStatus() {
               return this.componentBlock == '1' ? 'Unblock' : 'Block';
            }
        },
        methods: {
            blockUser(){
                this.$http.get(`/intranet/user/blocked/${this.userId}`).then(
                    function (response, status, request) {
                        this.componentBlock = response.body.data;
                    }, function (error) {
                        console.log('error');
                    });
            }
        }
    }


</script>

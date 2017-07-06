<template>
    <div>
        <form>
            <button @click.prevent="upvote"
                    class="btn btn-default">+1</button>
            Puntuación actual: <strong id="current-score">{{ score }}</strong>
            <button @click.prevent="downvote"
                    class="btn btn-default">-1</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['score'],
        methods: {
            upvote() {
                axios.post(window.location.href + '/upvote')
            },
        }
    }
</script>
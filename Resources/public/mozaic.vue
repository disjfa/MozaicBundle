<style>
    .mozaic-base {
        position: relative;
        width: 100%;
        height: 600px;
    }

    .mozaic-piece {
        position: absolute;
        cursor: pointer;
        transition: .1s;
        z-index: 1000;
    }
    .mozaic-piece.active {
        box-shadow: 0 0 20px #000;
        transform: scale(1.1);
        z-index: 1010;
    }
</style>
<template>
    <div>
        <div class="mozaic-base">
            <div v-for="piece in mozaic">
                <img :src="piece.shuffled.image" :style="getStyles(piece)" class="mozaic-piece" @click="checkPiece(piece)" :class="{'active': isActivePiece(piece)}">
            </div>
        </div>
        <div>
            ClickCount: <span class="tag tag-success">{{ clickCount }}</span>

            <span class="tag tag-success" v-if="done">Success</span>
        </div>

    </div>
</template>
<script>
    import Vue from 'vue';

    export default {
        props: ['unsplashRoute', 'token', 'finishRoute'],
        data () {
            return {
                activePiece: false,
                done: false,
                mozaic: {},
                shuffled: [],
                clickCount: 0,
            }
        },
        mounted () {
            this.initData();

            var mozaicBase = $(this.$el).find('.mozaic-base');
            $(window).on('resize', function() {
                $(mozaicBase).css({'height': ($(mozaicBase).width()/16*9) + 'px'});
            });
            $(mozaicBase).css({'height': ($(mozaicBase).width()/16*9) + 'px'});
        },
        methods: {
            isActivePiece(piece) {
                if(false === this.activePiece) {
                    return false;
                }

                return this.activePiece.x === piece.x && this.activePiece.y === piece.y;
            },
            areWeDone() {
                if(this.done) {
                    return false;
                }
                for(var i in this.mozaic) {
                    if(this.mozaic[i].x !== this.mozaic[i].shuffled.x) {
                        return false;
                    }
                    if(this.mozaic[i].y !== this.mozaic[i].shuffled.y) {
                        return false;
                    }
                }

                this.finished();
                this.done = true;
            },
            finished() {
                this
                    .$http
                    .post(this.finishRoute, {
                        token: this.token,
                    })
                    .then(function (result) {
                        console.log(result);
                    });
            },
            checkPiece(piece) {
                if(this.done) {
                    return;
                }
                if(false === this.activePiece) {
                    Vue.set(this, 'activePiece', piece)
                    return;
                }

                var activeShuffle = this.activePiece.shuffled;
                var shuffle = piece.shuffled;

                this.activePiece.shuffled = shuffle;
                piece.shuffled = activeShuffle;

                this.clickCount ++;
                this.activePiece = false;
                this.areWeDone();
            },
            getStyles(col) {
                let prc = this.done ? 0 : 1;
                return {
                    left: col.percent.left + '%',
                    top: col.percent.top + '%',
                    width: (col.percent.width-prc) + '%',
                    height: (col.percent.height-prc) + '%'
                }
            },
            initData() {
                this
                    .$http
                    .get(this.unsplashRoute)
                    .then(function (result) {
                        this.setupMozaic(result.data);
                    });
            },
            shuffle(a) {
                var array = [];
                var i;
                for(i in a) {
                    array.push(a[i]);
                }
                var copy = [], n = array.length, i;

                while (n) {
                    i = Math.floor(Math.random() * array.length);

                    if (i in array) {
                        copy.push(array[i]);
                        delete array[i];
                        n--;
                    }
                }

                Vue.set(this, 'shuffled', copy);
            },
            setupMozaic(data) {
                this.shuffle(data.mozaic);
                for(let i in this.shuffled) {
                    data.mozaic[i]['shuffled'] = this.shuffled[i];
                }

                Vue.set(this, 'mozaic', data.mozaic);
            }
        }
    }




</script>
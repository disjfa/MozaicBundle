<style>
    .mozaic-base {
        position: relative;
        width: 100%;
        height: 600px;
    }

    .mozaic-col {
        position: absolute;
    }
</style>
<template>
    <div>

        <div class="mozaic-base">
            <div v-for="row in mozaic">
                <div v-for="col in row">
                    <img v-if="col" :src="col.image" :style="getStyles(col)" class="mozaic-col">
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue';

    export default {
        props: ['unsplashRoute'],
        data () {
            return {
                mozaic: {},
                shuffled: {}
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
            getStyles(col) {
                return {
                    left: col.percent.left + '%',
                    top: col.percent.top + '%',
                    width: (col.percent.width-1) + '%',
                    height: (col.percent.height-1) + '%'
                }
            },
            initData() {
                this
                    .$http
                    .get(this.unsplashRoute)
                    .then(function (result) {
                        Vue.set(this, 'mozaic', result.data.mozaic);
                    });
            },
            addElement () {
                this.picture.addElement();
            }
        }
    }




</script>
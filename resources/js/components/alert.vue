<template>
<transition name="modal">
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container">

                <div class="modal-body">
                    <slot name="body">
                      <button class="float-right" @click="$emit('close')">
                        <jam-close/>
                      </button>
                      <h4>{{this.alertMessage}}</h4>
                    </slot>
                </div>
            </div>
        </div>
    </div>
</transition>
</template>
<script>
export default {
    name: 'alert',
    props: ['alertMessage'],
    data() {
        return {

        }
    },
    methods: {

    }
}
</script>

<style scoped>
    button {
        background-color: transparent;
        padding: 0px!important;
        border: none!important;
    }
</style>

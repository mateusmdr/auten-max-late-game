<template>
    <InputContainer name="Pesquisar">
        <div class="position-relative">
            <input type="text" @input="$emit('input',$event.target.value)" :value="value"/>
            <div class="search-icon">
                <Icon name="search"/>
            </div>
        </div>
    </InputContainer>
</template>

<script>
import InputContainer from './InputContainer.vue';
import Icon from './Icon.vue';

export default {
    components: {
        InputContainer,
        Icon
    },
    props: {
        value: String,
    },
}
</script>

<style scoped>
    .search-icon {
        position: absolute;
        top: 50%;
        right: 1rem;

        transform: translateY(-50%);
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        color: #BFC9DB;
        pointer-events: none;
    }

    input {
        height: 3rem;
        border-radius: .5rem;
        width: 100%;

        background-color: #4F4F4F;
        color: #BFC9DB;
        padding: 0 1rem;
        box-sizing: border-box;

        border: 0;
        outline: 0;
    }
</style>
<template>
    <InputContainer :name="label">
        <div class="position-relative">
            <input id="file" type="file" @change="$emit('change',$event.target.files[0]); this.selected = true; this.filename = $event.target.files[0].name" :accept="mime"/>
            <label for="file" class="position-relative">
                {{selected ? filename : 'Selecionar arquivo'}}
                <div class="input-icon">
                    <Icon name="attach_file"/>
                </div>
            </label>
            <h5 class="mt-2 fw-light">{{hint}}</h5>
        </div>
    </InputContainer>
</template>

<script>
export default {
    emits: ['change'],
    props: {
        label: String,
        hint: {
            type: String,
            default: null
        },
        mime: {
            type: String,
            default: null
        }
    },
    data() {
        return {
            selected: false,
            filename: null
        }
    }
}
</script>

<style scoped>
    label {
        height: 3rem;
        border-radius: .5rem;
        width: 100%;

        background-color: #4F4F4F;
        color: #BFC9DB;
        padding: 0 1rem;
        box-sizing: border-box;

        border: 0;
        outline: 0;
        cursor: pointer;
        display: flex;
        align-items: center;
    }
    input[type="file"] {
        display: none;
    }
</style>
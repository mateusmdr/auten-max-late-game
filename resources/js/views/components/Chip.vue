<template>
    <button class="custom-chip" :class="selected ? 'selected' : ''">
        <div class="d-flex flex-row">
            <div v-if="hasIcon" class="circle me-2" :style="`background-color: ${color};`"></div>
            <h6>{{ text }}</h6>
        </div>
    </button>
</template>

<script>
export default {
    props: {
        hasIcon: {
            type: Boolean,
            default: true
        },
        color: String,
        text: String,
        selected: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<style lang="scss" scoped>
    .custom-chip {
        padding: 8px 12px;
        border-radius: 1rem;
        background-color: #232323;
        display: inline-block;
        vertical-align: middle;
        cursor: pointer;
        transition: .3s;
        outline: 0;
        border: 0;

        h6 {
            color: #7F8896;
            font-weight: 600;
            margin: 0;
        }

        &.selected {
            background-color: #3E3E3E;
            h6 {
                color: #F2F5FA;
                font-weight: 700;
            }
        }
    }

    .custom-chip:hover {
        background-color: #3E3E3E;

        h6 {
            color: #F2F5FA;
        }

        &.selected {
            background-color: #232323;
        }
    }
</style>
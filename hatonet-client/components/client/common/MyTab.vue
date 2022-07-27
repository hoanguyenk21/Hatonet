<template>
    <section v-show="isActive" :id="computedId" :aria-hidden="!isActive" class="tabs-component-panel" role="tabpanel">
        <slot />
    </section>
</template>


<script>
export default {
    props: {
        id: {
            type: String,
            default: null
        },
        name: {
            type: String,
            default: null
        },
        prefix: {
            type: String,
            default: null
        },
        suffix: {
            type: String,
            default: null
        },
        isDisabled: {
            type: Boolean,
            default: false
        }
    },
    data: () => ({
        isActive: false,
        isVisible: true
    }),
    computed: {
        header() {
            return this.name;
        },
        computedId() {
            return this.id ? this.id : this.name.toLowerCase().replace(/ /g, '-');
        },
        hash() {
            if (this.isDisabled) {
                return '#';
            }
            return '#' + this.computedId;
        }
    }
};
</script>

<style lang="scss">
.tabs-component-tabs {
    padding: 0 !important;
    background: #f2f3f7;
}

@media (min-width: 700px) {
    .tabs-component-tabs {
        border: 0;
        align-items: stretch;
        display: flex;
        justify-content: flex-start;
        margin-bottom: -1px;
    }
}

.tabs-component-tab {
    color: #000;
    font-size: 15px;
    font-weight: 600;
    margin-right: 0;
    list-style: none;
}

.tabs-component-tab:hover {
    color: #666;
    
}

.tabs-component-tab.is-active {
    color: #000;
    background-color: #fff;
}

.tabs-component-tab.is-disabled * {
    color: #cdcdcd;
    cursor: not-allowed !important;
}

@media (min-width: 700px) {
    .tabs-component-tab {
        background-color: #d7d7d775;
        border-radius: 4px 4px 0 0;
        transition: transform .3s ease;
    }

    .tabs-component-tab.is-active {
        border-bottom: solid 1px #fff;
        z-index: 2;
        transform: translateY(0);
    }
}

.tabs-component-tab-a {
    align-items: center;
    color: inherit;
    display: flex;
    padding: 15px 20px;
    text-decoration: none;
    color: #ff6116 !important
    
}
.admin a:hover {
    color: #ff6116 !important;
    text-decoration: none !important;
}

</style>
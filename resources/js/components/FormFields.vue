<template>
    <b-row class="mt-2">
        <b-col cols="3">
            <div class="p-2 alert alert-secondary">
                <h3>fields</h3>
                <draggable
                    class="list-group"
                    :list="fields"
                    group="fields">
                    <div class="list-group-item" v-for="element in fields" :key="element.name">
                        {{element.name}}
                    </div>
                </draggable>
            </div>
        </b-col>
        <b-col cols="9">
            <div class="p-2 alert alert-primary">
                <h3>In Progress</h3>
                <draggable
                    class="list-group"
                    :list="formFields"
                    group="fields">
                    <div class="list-group-item" v-for="element in formFields" :key="element.name">
                        {{element.name}}
                    </div>
                </draggable>
            </div>
        </b-col>
    </b-row>
</template>

<script>
    import axios from 'axios'
    import draggable from 'vuedraggable'

    export default {
        name: 'FormFields',
        components: {
            draggable
        },
        data() {
            return {
                show: false,
                fields: [
                    {name: "text"},
                    {name: "select"},
                ],
                formFields: []

            }
        },
        created() {
            this.get();
        },

        computed: {
            totalPrice: function () {
                return 0;
            }
        },

        methods: {

            get() {
                axios
                    .get('/api/form-generator/forms/' + this.entityId)
                    .then(response => (this.fields = response.data.data.fields))
            },

        }
    }
</script>

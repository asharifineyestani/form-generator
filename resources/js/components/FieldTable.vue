<template>
    <div>

        <div class="form-group row">
            <div class="col-md-8">
                <input class="form-control" type="text" placeholder=".col-md-8" autocomplete="off" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
            </div>
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder=".col-md-4" autocomplete="off" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
            </div>
        </div>


        <table class="table table-responsive-sm">
            <tbody>
            <tr v-for="item in data">

                <template v-if="editRow.id == item.id">
                    <td>{{item.id}}</td>
                    <td><input v-model="editRow.title" type="text"></td>
                    <td>
                        <v-select
                            v-model="editRow.type"
                            taggable
                            push-tags
                            :options="fieldTypes"
                        ></v-select>
                    </td>
                    <td>
                        <button
                            class="btn btn-sm btn-success"
                            type="button"
                            @click="update(editRow)">
                            Submit
                        </button>
                        <button
                            class="btn btn-sm btn-danger"
                            type="button"
                            @click="reset">
                            Cancel
                        </button>
                    </td>


                </template>
                <template v-else>
                    <td>{{item.id}}</td>
                    <td>
                        <a :href="'/fields/' + item.id +  '/edit'">{{item.title}}</a>
                    </td>


                    <td>{{item.type}}</td>
                    <td>

                        <div v-if="Object.keys(editRow).length === 0 && creatInput === false">
                            <button class="btn btn-sm btn-primary" type="button"
                                    @click="edit(item)"
                            >Edit
                            </button>
                            <button
                                class="btn btn-sm btn-danger"
                                type="button"
                                @click="destroy(item)"
                            >
                                Delete
                            </button>
                        </div>

                    </td>
                </template>


            </tr>


            <tr v-if="creatInput === false">

                <td>

                    <button class="btn btn-ghost-success"
                            type="button"
                            @click="create()">
                        +
                    </button>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr v-else>
                <td>
                    <span class="badge badge-danger">New</span>
                </td>
                <td>
                    <input class="form-control" v-model="newRow.title" type="text" placeholder="Enter your name">

                </td>

                <td>
                    <v-select
                        v-model="newRow.type"
                        taggable
                        push-tags
                        :options="fieldTypes"
                    ></v-select>
                </td>
                <td>
                    <button
                        class="btn btn-sm btn-success"
                        type="button"
                        @click="store"
                    >
                        Create
                    </button>
                    <button
                        class="btn btn-sm btn-danger"
                        type="button"
                        @click="reset">
                        Cancel
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    import axios from 'axios'


    export default {
        data() {
            return {
                fieldTypes : [],
                data: [],
                editRow: {},
                newRow: {},
                editId: null,
                creatInput: false,
                entityId: window.location.href.split('/')[4]
            }
        },
        created() {
            this.get();
        },
        methods: {

            get() {
                axios
                    .get('/api/form-generator/forms/' + this.entityId)
                    .then(response => (this.data = response.data.fields))


                axios
                    .get('/api/form-generator/config')
                    .then(response => (this.fieldTypes = response.data.fieldTypes))
            },

            onEdit(product) {

            },
            update(item) {
                axios
                    .put('/api/form-generator/fields/' + item.id, this.editRow)


                this.reset()
            },

            store() {
                this.newRow.category_id = this.entityId;
                axios
                    .post('/api/form-generator/fields/', this.newRow)

                this.reset()
            },

            destroy(item) {
                axios
                    .delete('/api/form-generator/fields/' + item.id)

                this.reset()
            },
            onreset() {

            },
            edit(item) {
                this.editRow = item
            },

            reset() {
                this.editRow = {}
                this.creatInput = false
                this.get()
            },

            create() {
                this.editRow = {}
                this.creatInput = true
            }

        }
    }
</script>

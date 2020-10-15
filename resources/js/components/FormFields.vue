<template>

    <b-row class="mt-2">
        <b-col cols="3">
            <div class="p-2 alert alert-secondary"    v-if="sidebar === 'showFields'">
                <h3>افزودن فیلد</h3>
                <draggable
                    class="list-group"
                    :list="fields"
                    :group="{ name: 'fields', pull: 'clone', put: false }">
                    <div class="list-group-item" v-for="element in fields" :key="element.name">
                        {{element.name}}
                    </div>
                </draggable>
            </div>

            <div class="p-2 alert alert-secondary"   v-else>
                <h3>{{activeField.name}}</h3>
                <button  @click="showFieldsInSidebar">C</button>


                <div class="form-group">
                    <input type="text" class="form-control" v-model="formFields[0].name">

                </div>

            </div>
        </b-col>
        <b-col cols="9">
            <div class="p-2 alert alert-primary">
                <h3>{{form.name}}</h3>
                <draggable
                    class="list-group"
                    :list="formFields"
                    group="fields">


                    <div class="form-group"
                         v-bind:class="{ active: element.style.active }"
                         v-for="(element , index) in formFields" :key="index"
                    >
                        <label>{{element.name}}</label>
                        <input type="email" class="form-control" aria-describedby="emailHelp"
                               :placeholder="element.placeholder"
                               @click="makeActiveField($event , index)">
                        <small class="form-text text-muted">{{element.description}}</small>
                        <button class="delete" @click="deleteField(index)">D</button>
                        <button class="clone" @click="cloneField(element)">C</button>

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
                sidebar : 'showFields',
                test: null,
                show: false,
                fields: [
                    {
                        name: "متن",
                        type: "text",
                        icon: "text",
                        description: "We'll never share your email with anyone else.",
                        placeholder: "Enter email",
                        required: true,
                        style: {
                            active: false
                        }
                    },
                    {
                        name: "انتخاب",
                        type: "select",
                        icon: "text",
                    },
                ],
                formFields: [
                    {
                        name: "111",
                        type: "text",
                        icon: "text",
                        description: "We'll never share your email with anyone else.",
                        placeholder: "Enter email",
                        required: true,
                        style: {
                            active: false
                        }
                    },
                    {
                        name: "222",
                        type: "text",
                        icon: "text",
                        description: "We'll never share your email with anyone else.",
                        placeholder: "Enter email",
                        required: true,
                        style: {
                            active: false
                        }
                    }
                ],
                form: {
                    name: "نام فرم"
                }

            }
        },
        created() {
        },

        computed: {
            totalPrice: function () {
                return 0;
            },

            activeField() {
                return this.formFields.filter(function(el){
                    return el.style.active === true;
                })[0];

            }
        },

        methods: {

            showFieldsInSidebar() {
                this.inActiveFields();
                this.sidebar = 'showFields';
            },

            inActiveFields() {
                for (let i = 0; i < this.formFields.length; i++)
                    this.formFields[i].style.active = false;
            },

            makeActiveField(value, index) {

                this.inActiveFields();

                let newField = Object.assign({}, this.formFields, {...this.formFields[index],...{style: {active: true}}});
                Vue.set(this.formFields, index, newField);



                this.sidebar = 'activeField';

            },

            cloneField(value) {

                this.inActiveFields();

                this.formFields.push(value);

                this.makeActiveField(null , this.formFields.length - 1)
            },


            deleteField(index) {

                this.formFields.splice(index, 1);

            }
        }
    }
</script>


<style scoped lang="scss">

    .active {
        border: 1px yellow solid;
        background: #f3f397;
        padding: 15px;
        margin-bottom: 15px;
    }


    .form-group {
        position: relative;
        margin-bottom: 24px;

        button {
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            background: black;
            color: white;
            position: absolute;
            right: 15px;
            bottom: -15px;
            display: none;
        }
    }




    .active button {
        display: block;
    }

    button.delete {
        right: 60px;
        background: red;
    }


    *[dir="rtl"] {
        button {

            right: inherit;
            left: 15px;
            bottom: -15px;

        }

        button.delete {
            right: inherit;
            left: 60px;

        }
    }






</style>

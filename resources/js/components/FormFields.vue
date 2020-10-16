<template>

    <b-row class="mt-2">

        <b-col cols="3">

            <div class="p-2 alert alert-secondary" v-if="activeFieldId !== null">
                <h3>{{formFields[activeFieldId].name}}</h3>
                <button @click="showFieldsInSidebar">C</button>

                <b-form-group label="نام:">
                    <input type="text" class="form-control" v-model="formFields[activeFieldId].name">
                </b-form-group>
                <b-form-group label="توضیحات:">
                    <input type="text" class="form-control" v-model="formFields[activeFieldId].description">
                </b-form-group>
                <b-form-group label="مقدار راهنما:">
                    <input type="text" class="form-control" v-model="formFields[activeFieldId].placeholder">
                </b-form-group>
                <b-form-group label="مقدار پیشفرض:">
                    <input type="text" class="form-control" v-model="formFields[activeFieldId].value">
                </b-form-group>


                <b-form-group label="تنظیمات:">
                    <b-form-checkbox v-model="formFields[activeFieldId].label">عنوان</b-form-checkbox>
                    <b-form-checkbox v-model="formFields[activeFieldId].required"
                                     :disabled=" ! (formFields[activeFieldId].label)">اجباری
                    </b-form-checkbox>
                    <b-form-checkbox v-model="formFields[activeFieldId].disabled">غیرفعال</b-form-checkbox>
                    <b-form-checkbox v-model="formFields[activeFieldId].hidden">پنهان</b-form-checkbox>
                </b-form-group>


                <b-button-group>
                    <b-button @click="changeCol(4)">کوچک</b-button>
                    <b-button @click="changeCol(6)">متوسط</b-button>
                    <b-button @click="changeCol(12)">بزرگ</b-button>
                </b-button-group>


            </div>
            <div class="p-2 alert alert-secondary" v-else>
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
                         @click="makeActiveField(index)"

                    >
                        <label v-if="element.label"> <span v-if="element.required">*</span> {{element.name}}
                        </label>

                        <div v-if="element.hidden">Hidden</div>
                        <b-col :cols="element.col">
                            <b-form-input
                                :placeholder="element.placeholder"
                                :disabled="element.disabled"
                                :value="element.value"
                            ></b-form-input>
                        </b-col>

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
                activeFieldId: null,
                test: null,
                show: false,
                fields: [
                    {
                        name: "متن",
                        type: "text",
                        icon: "text",
                        description: '',
                        placeholder: '',
                        required: false,
                        disabled: false,
                        hidden: false,
                        label: true,
                        value: null,
                        col: 12,
                        style: {
                            active: false
                        }
                    },
                    {
                        name: "انتخاب",
                        type: "select",
                        icon: "text",
                        placeholder: '',
                        required: false,
                        disabled: false,
                        hidden: false,
                        label: true,
                        value: null,
                        col: 12,
                        style: {
                            active: false
                        }
                    },
                ],
                formFields: [
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
        },

        methods: {


            changeCol(value) {
                this.formFields[this.activeFieldId].col = value;
            },

            showFieldsInSidebar() {
                this.inActiveFields();
                this.activeFieldId = null;
            },

            inActiveFields() {
                for (let i = 0; i < this.formFields.length; i++)
                    this.formFields[i].style.active = false;
            },

            makeActiveField( index) {

                this.inActiveFields();

                let newField = Object.assign({}, this.formFields, {...this.formFields[index], ...{style: {active: true}}});
                Vue.set(this.formFields, index, newField);


                this.activeFieldId = index;

            },

            cloneField(value) {

                this.inActiveFields();

                this.formFields.push(value);

                this.makeActiveField(null, this.formFields.length - 1)
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

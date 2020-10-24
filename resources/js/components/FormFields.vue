<template>

    <b-row class="mt-2">

        <b-col cols="3">

            <div class="p-2 alert alert-secondary" v-if="activeFieldId !== null">
                <h3>{{formFields[activeFieldId].name}}</h3>
                <button @click="showFieldsInSidebar">C</button>


                <b-modal
                    id="modal-prevent-closing"
                    ref="modal"
                    :title="formFields[activeFieldId].name"
                    @ok="handleOk"
                    ok-title="افزودن آیتم جدید"
                    cancel-title="بستن"
                >

                    <template>
                        <b-button @click="setModalOption('table')" v-if="modalOption == 'form'">مشاهده آپشن ها</b-button>
                    </template>
                    <b-table
                        v-if="modalOption == 'table'"
                        show-empty
                        small
                        stacked="md"
                        :items="formFields[activeFieldId].options"
                        :fields="tableFields"
                    >
                        <template #cell(name)="row">
                            {{ row.value.first }} {{ row.value.last }}
                        </template>

                        <template #cell(actions)="row">
                            <b-button size="sm" @click="deleteOption(row.item, row.index, $event.target)"
                                      class="mr-1 btn-danger">
                               حذف
                            </b-button>
                            <b-button size="sm" @click="row.toggleDetails">
                                {{ row.detailsShowing ? ' پنهان' : 'نمایش جزییات' }}
                            </b-button>
                        </template>

                        <template #row-details="row">
                            <b-card>
                                <ul>
                                    <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
                                </ul>
                            </b-card>
                        </template>
                    </b-table>
                    <form ref="form" @submit.stop.prevent="handleSubmitNewOption"
                          v-else
                    >
                        <b-form-group
                            label="برچسب"
                            invalid-feedback="Label is required"
                        >
                            <b-form-input
                                v-model="newOption.label"
                                required
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                            v-if="form.price == true "
                            label="قیمت"
                        >
                            <b-form-input
                                v-model="newOption.price"
                                type="number"
                            ></b-form-input>

                        </b-form-group>


                        <b-form-group
                            label="مقدار پیشفرض"
                        >

                            <b-form-input
                                v-model="newOption.value"
                                type="text"
                            ></b-form-input>

                        </b-form-group>


                    </form>
                </b-modal>

                <b-form-group label="نام:" v-if="formFields[activeFieldId].hasOwnProperty('name')">
                    <input type="text" class="form-control" v-model="formFields[activeFieldId].name">
                </b-form-group>
                <b-form-group label="توضیحات:" v-if="formFields[activeFieldId].hasOwnProperty('description')">
                    <input type="text" class="form-control" v-model="formFields[activeFieldId].description">
                </b-form-group>
                <b-form-group label="مقدار راهنما:" v-if="formFields[activeFieldId].hasOwnProperty('placeholder')">
                    <input type="text" class="form-control" v-model="formFields[activeFieldId].placeholder">
                </b-form-group>
                <b-form-group label="مقدار پیشفرض:" v-if="formFields[activeFieldId].hasOwnProperty('value')">
                    <input type="text" class="form-control" v-model="formFields[activeFieldId].value">
                </b-form-group>

                <b-form-group label="گزینه ها:" v-if="formFields[activeFieldId].hasOwnProperty('options')">
                    <b-button v-b-modal.modal-prevent-closing>مدیریت گزینه ها</b-button>
                </b-form-group>

                <b-form-group label="رنگ:" v-if="formFields[activeFieldId].hasOwnProperty('color')">
                    <input type="text" class="form-control" v-model="formFields[activeFieldId].color">
                </b-form-group>

                <b-form-group label="رنگ سوییچ:" v-if="formFields[activeFieldId].hasOwnProperty('switchColor')">
                    <input type="text" class="form-control" v-model="formFields[activeFieldId].switchColor">
                </b-form-group>

                <div class="row"
                     v-if="formFields[activeFieldId].hasOwnProperty('min') && formFields[activeFieldId].hasOwnProperty('max')">
                    <div class="col">
                        <label>حداقل</label>
                        <input type="number" class="form-control" v-model="formFields[activeFieldId].min">
                    </div>
                    <div class="col">
                        <label>حداکثر</label>
                        <input type="number" class="form-control" v-model="formFields[activeFieldId].max">
                    </div>
                </div>

                <b-form-group label="" v-if="formFields[activeFieldId].hasOwnProperty('switch')">
                    <div class="row">
                        <div class="col">
                            <label>برچسب غیرفعال</label>
                            <input type="text" class="form-control" v-model="formFields[activeFieldId].switch[0].label">
                        </div>
                        <div class="col">
                            <label>برچسب فعال</label>
                            <input type="text" class="form-control" v-model="formFields[activeFieldId].switch[1].label">
                        </div>
                    </div>
                </b-form-group>


                <b-form-group label="وضعیت اولیه:" v-if="formFields[activeFieldId].hasOwnProperty('switchValue')">
                    <toggle-button
                        width="92"
                        height="28"
                        v-model="formFields[activeFieldId].switchValue"
                        :sync="true"
                        :labels="{'unchecked' : 'unchecked','checked' : 'checked'}"
                    />
                </b-form-group>


                <b-form-group
                    v-if="formFields[activeFieldId].hasOwnProperty('maxRows') && formFields[activeFieldId].hasOwnProperty('rows')">
                    <div class="row">
                        <div class="col">
                            <label>سطر</label>
                            <input type="number" class="form-control" v-model="formFields[activeFieldId].rows">
                        </div>
                        <div class="col">
                            <label>حداکثر سطر</label>
                            <input type="number" class="form-control" v-model="formFields[activeFieldId].maxRows">
                        </div>
                    </div>
                </b-form-group>


                <b-form-group
                    v-if="formFields[activeFieldId].hasOwnProperty('with') && formFields[activeFieldId].hasOwnProperty('height')">
                    <div class="row">
                        <div class="col">
                            <label>عرض</label>
                            <input type="number" class="form-control" v-model="formFields[activeFieldId].with">
                        </div>
                        <div class="col">
                            <label>طول</label>
                            <input type="number" class="form-control" v-model="formFields[activeFieldId].height">
                        </div>
                    </div>
                </b-form-group>


                <b-form-group label="تنظیمات:">
                    <b-form-checkbox v-model="formFields[activeFieldId].label"
                                     v-if="formFields[activeFieldId].hasOwnProperty('label')">عنوان
                    </b-form-checkbox>
                    <b-form-checkbox v-model="formFields[activeFieldId].required"
                                     v-if="formFields[activeFieldId].hasOwnProperty('required')"
                                     :disabled=" ! (formFields[activeFieldId].label)">اجباری
                    </b-form-checkbox>
                    <b-form-checkbox v-model="formFields[activeFieldId].disabled"
                                     v-if="formFields[activeFieldId].hasOwnProperty('disabled')">غیرفعال
                    </b-form-checkbox>
                    <b-form-checkbox v-model="formFields[activeFieldId].hidden"
                                     v-if="formFields[activeFieldId].hasOwnProperty('hidden')">پنهان
                    </b-form-checkbox>
                    <b-form-checkbox v-model="formFields[activeFieldId].taggable"
                                     v-if="formFields[activeFieldId].hasOwnProperty('taggable')">taggable
                    </b-form-checkbox>
                    <b-form-checkbox v-model="formFields[activeFieldId].multiple"
                                     v-if="formFields[activeFieldId].hasOwnProperty('multiple')">چندتایی
                    </b-form-checkbox>
                    <b-form-checkbox v-model="formFields[activeFieldId].pushTags"
                                     v-if="formFields[activeFieldId].hasOwnProperty('pushTags')">push-tags
                    </b-form-checkbox>
                </b-form-group>


                <b-form-group label="اندازه:">
                    <b-button-group v-if="formFields[activeFieldId].hasOwnProperty('col')">
                        <b-button @click="changeCol(4)">کوچک</b-button>
                        <b-button @click="changeCol(6)">متوسط</b-button>
                        <b-button @click="changeCol(12)">بزرگ</b-button>
                    </b-button-group>
                </b-form-group>


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


                            <v-select
                                dir="rtl"
                                v-if="element.type == 'select-image'"
                                :options="element.options"
                                :multiple="element.multiple"
                                :taggable="element.taggable"
                                :push-tags="element.pushTags"

                            >
                            </v-select>


                            <toggle-button
                                v-if="element.type == 'switch'"
                                :sync="true"
                                :width="element.with"
                                :height="element.height"
                                :color="element.color"
                                :switch-color="element.switchColor"
                                :value="element.switchValue"
                                :disabled="element.disabled"
                                :labels="{'unchecked' : element.switch[0].label,'checked' : element.switch[1].label}"
                            />


                            <b-form-textarea
                                v-if="element.type == 'textarea'"
                                :placeholder="element.placeholder"
                                :disabled="element.disabled"
                                :value="element.value"
                                :rows="element.rows"
                                :max-rows="element.maxRows"
                            ></b-form-textarea>


                            <b-form-input
                                v-if="element.type == 'number'"
                                :placeholder="element.placeholder"
                                :disabled="element.disabled"
                                :value="element.value"
                                type="number"
                                :min="element.min" :max="element.max"
                            ></b-form-input>


                            <b-form-input
                                v-if="element.type == 'email'"
                                :placeholder="element.placeholder"
                                :disabled="element.disabled"
                                :value="element.value"
                                type="email"
                            ></b-form-input>


                            <b-form-input
                                v-if="element.type == 'text'"
                                :placeholder="element.placeholder"
                                :disabled="element.disabled"
                                :value="element.value"
                                :maxlength="element.max"
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
                newOption: {},
                editOption: {},
                modalOption: 'table',
                tableFields: [
                    {key: 'label', label: 'برچسب', sortable: true, sortDirection: 'desc'},
                    {key: 'price', label: 'قیمت', sortable: true, sortDirection: 'desc'},
                    {key: 'value', label: 'پیشفرض', sortable: true, sortDirection: 'desc'},
                    {key: 'actions', label: 'Actions'}
                ],
                totalRows: 1,
                currentPage: 1,
                perPage: 5,
                pageOptions: [5, 10, 15],
                sortBy: '',
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                filterOn: [],
                infoModal: {
                    id: 'info-modal',
                    title: '',
                    content: ''
                },
                activeFieldId: null,
                test: null,
                show: false,

                fields: [
                    {
                        name: "نوع چوب",
                        type: "select-image",
                        price: 0,
                        col: 6,
                        description: '',
                        required: false,
                        disabled: false,
                        hidden: false,
                        label: true,
                        taggable: true,
                        multiple: true,
                        pushTags: true,
                        style: {
                            active: false
                        },
                        options: [
                            {
                                key: 1,
                                label: "گردو",
                                price: 21000,
                                src: "/uploads/choob1.jpg",
                                value: null
                            },
                            {
                                key: 2,
                                label: "پسته",
                                price: 8922,
                                src: "/uploads/choob1.jpg",
                                value: null
                            },
                            {
                                key: 2,
                                label: "زعفران",
                                price: 666,
                                src: "/uploads/choob1.jpg",
                                value: null
                            }
                        ]
                    },
                    {
                        name: "سوییچ",
                        type: "switch",
                        icon: "boolean",
                        switchValue: true,
                        with: 92,
                        height: 28,
                        color: "#BFCBD9",
                        switchColor: "#ffffff",
                        switch: [
                            {
                                price: 0,
                                label: 'unchecked'
                            },
                            {
                                price: 1000000,
                                label: "checked"
                            }
                        ],
                        description: '',
                        required: false,
                        disabled: false,
                        hidden: false,
                        label: true,
                        style: {
                            active: false
                        }
                    },
                    {
                        name: "ایمیل",
                        type: "email",
                        icon: "email",
                        description: '',
                        placeholder: '',
                        required: false,
                        disabled: false,
                        hidden: false,
                        label: true,
                        col: 12,
                        style: {
                            active: false
                        }
                    },
                    {
                        name: "متن چند خطی",
                        type: "textarea",
                        icon: "text",
                        rows: 1,
                        maxRows: 5,
                        description: '',
                        placeholder: '',
                        required: false,
                        disabled: false,
                        hidden: false,
                        label: true,
                        value: '',
                        col: 12,
                        style: {
                            active: false
                        }
                    },
                    {
                        name: "متن",
                        type: "text",
                        icon: "text",
                        min: 1,
                        max: 5,
                        description: '',
                        placeholder: '',
                        required: false,
                        disabled: false,
                        hidden: false,
                        label: true,
                        value: '',
                        col: 12,
                        style: {
                            active: false
                        }
                    },
                    {
                        name: "عدد",
                        type: "number",
                        icon: "text",
                        min: 1,
                        max: 5,
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
                formFields: [],
                form: {
                    name: "نام فرم",
                    price: true,
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

            handleOk(bvModalEvt) {

                bvModalEvt.preventDefault()
                this.handleSubmitNewOption()
            },

            setModalOption(value) {
                this.modalOption = value;
            },

            handleSubmitNewOption() {

                if (this.modalOption == 'table' || Object.keys(this.newOption).length === 0 && this.newOption.constructor === Object) {
                    this.modalOption = 'form';
                    return 0;
                }


                this.formFields[this.activeFieldId].options.push(this.newOption);
                this.modalOption = 'table';
                this.newOption = {};
            },


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

            makeActiveField(index) {

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
            },

            deleteOption(item, index, event) {
                console.log(item)
                console.log(index)
                console.log(event)
                this.formFields[this.activeFieldId].options.splice(index, 1);
            },

            setEditOption(item, index, event) {
                console.log(item)
                console.log(index)
                console.log(event)
                this.formFields[this.activeFieldId].options.splice(index, 1);
            },

            containsObject(obj, list) {
                let i;
                for (i = 0; i < list.length; i++) {
                    if (list[i] === obj) {
                        return true;
                    }
                }

                return false;
            }
        }
    }
</script>


<style scoped lang="scss">


    .list-group {
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


    }

    *[dir="rtl"] {
        .list-group {
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

    }


</style>

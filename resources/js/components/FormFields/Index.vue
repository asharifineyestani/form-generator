<template>
    <b-row class="mt-2">
        <b-col cols="12">
            <button v-on:click="storeForm(form)">store form</button>
            <button v-on:click="updateForm(form)">update form</button>
        </b-col>
        <b-col cols="3">
            <div class="p-2 alert alert-secondary" v-if="activeFieldId !== null">
                <h3>{{ form.fields[activeFieldId].label }}</h3>
                <button @click="showFieldsInSidebar">C</button>
                <b-modal
                    id="modal-prevent-closing"
                    ref="modal"
                    :title="form.fields[activeFieldId].name"
                    @ok="handleOk"
                    ok-title="افزودن آیتم جدید"
                    cancel-title="بستن"
                >
                    <template>
                        <b-button @click="setModalOption('table')" v-if="modalOption == 'form'">مشاهده آپشن ها
                        </b-button>
                    </template>
                    <b-table
                        v-if="modalOption == 'table'"
                        show-empty
                        small
                        stacked="md"
                        :items="form.fields[activeFieldId].options"
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

                <b-form-group label="برچسب:" v-if="form.fields[activeFieldId].hasOwnProperty('label')">
                    <input type="text" class="form-control" v-model="form.fields[activeFieldId].label">
                </b-form-group>

                <b-form-group label="نام:" v-if="form.fields[activeFieldId].hasOwnProperty('name')">
                    <input type="text" class="form-control" v-model="form.fields[activeFieldId].name">
                </b-form-group>

                <b-form-group label="توضیحات:" v-if="form.fields[activeFieldId].hasOwnProperty('description')">
                    <input type="text" class="form-control" v-model="form.fields[activeFieldId].description">
                </b-form-group>
                <b-form-group label="مقدار راهنما:" v-if="form.fields[activeFieldId].hasOwnProperty('placeholder')">
                    <input type="text" class="form-control" v-model="form.fields[activeFieldId].placeholder">
                </b-form-group>
                <b-form-group label="مقدار پیشفرض:" v-if="form.fields[activeFieldId].hasOwnProperty('value')">
                    <input type="text" class="form-control" v-model="form.fields[activeFieldId].value">
                </b-form-group>

                <b-form-group label="گزینه ها:" v-if="form.fields[activeFieldId].hasOwnProperty('options')">
                    <b-button v-b-modal.modal-prevent-closing>مدیریت گزینه ها</b-button>
                </b-form-group>

                <b-form-group label="رنگ:" v-if="form.fields[activeFieldId].hasOwnProperty('color')">
                    <input type="text" class="form-control" v-model="form.fields[activeFieldId].color">
                </b-form-group>

                <b-form-group label="رنگ سوییچ:" v-if="form.fields[activeFieldId].hasOwnProperty('switchColor')">
                    <input type="text" class="form-control" v-model="form.fields[activeFieldId].switchColor">
                </b-form-group>

                <div class="row"
                     v-if="form.fields[activeFieldId].hasOwnProperty('min') && form.fields[activeFieldId].hasOwnProperty('max')">
                    <div class="col">
                        <label>حداقل</label>
                        <input type="number" class="form-control" v-model="form.fields[activeFieldId].min">
                    </div>
                    <div class="col">
                        <label>حداکثر</label>
                        <input type="number" class="form-control" v-model="form.fields[activeFieldId].max">
                    </div>
                </div>

                <b-form-group label="" v-if="form.fields[activeFieldId].hasOwnProperty('switch')">
                    <div class="row">
                        <div class="col">
                            <label>برچسب غیرفعال</label>
                            <input type="text" class="form-control" v-model="form.fields[activeFieldId].switch[0].label">
                        </div>
                        <div class="col">
                            <label>برچسب فعال</label>
                            <input type="text" class="form-control" v-model="form.fields[activeFieldId].switch[1].label">
                        </div>
                    </div>
                </b-form-group>


                <b-form-group label="وضعیت اولیه:" v-if="form.fields[activeFieldId].hasOwnProperty('switchValue')">
                    <toggle-button
                        width="92"
                        height="28"
                        v-model="form.fields[activeFieldId].switchValue"
                        :sync="true"
                        :labels="{'unchecked' : 'unchecked','checked' : 'checked'}"
                    />
                </b-form-group>


                <b-form-group
                    v-if="form.fields[activeFieldId].hasOwnProperty('maxRows') && form.fields[activeFieldId].hasOwnProperty('rows')">
                    <div class="row">
                        <div class="col">
                            <label>سطر</label>
                            <input type="number" class="form-control" v-model="form.fields[activeFieldId].rows">
                        </div>
                        <div class="col">
                            <label>حداکثر سطر</label>
                            <input type="number" class="form-control" v-model="form.fields[activeFieldId].maxRows">
                        </div>
                    </div>
                </b-form-group>


                <b-form-group
                    v-if="form.fields[activeFieldId].hasOwnProperty('with') && form.fields[activeFieldId].hasOwnProperty('height')">
                    <div class="row">
                        <div class="col">
                            <label>عرض</label>
                            <input type="number" class="form-control" v-model="form.fields[activeFieldId].with">
                        </div>
                        <div class="col">
                            <label>طول</label>
                            <input type="number" class="form-control" v-model="form.fields[activeFieldId].height">
                        </div>
                    </div>
                </b-form-group>


                <b-form-group label="تنظیمات:">
                    <b-form-checkbox v-model="form.fields[activeFieldId].hasLabel"
                                     v-if="form.fields[activeFieldId].hasOwnProperty('hasLabel')">عنوان
                    </b-form-checkbox>
                    <b-form-checkbox v-model="form.fields[activeFieldId].required"
                                     v-if="form.fields[activeFieldId].hasOwnProperty('required')"
                                     :disabled=" ! (form.fields[activeFieldId].label)">اجباری
                    </b-form-checkbox>
                    <b-form-checkbox v-model="form.fields[activeFieldId].disabled"
                                     v-if="form.fields[activeFieldId].hasOwnProperty('disabled')">غیرفعال
                    </b-form-checkbox>
                    <b-form-checkbox v-model="form.fields[activeFieldId].hidden"
                                     v-if="form.fields[activeFieldId].hasOwnProperty('hidden')">پنهان
                    </b-form-checkbox>
                    <b-form-checkbox v-model="form.fields[activeFieldId].taggable"
                                     v-if="form.fields[activeFieldId].hasOwnProperty('taggable')">taggable
                    </b-form-checkbox>
                    <b-form-checkbox v-model="form.fields[activeFieldId].multiple"
                                     v-if="form.fields[activeFieldId].hasOwnProperty('multiple')">چندتایی
                    </b-form-checkbox>
                    <b-form-checkbox v-model="form.fields[activeFieldId].pushTags"
                                     v-if="form.fields[activeFieldId].hasOwnProperty('pushTags')">push-tags
                    </b-form-checkbox>
                </b-form-group>


                <b-form-group label="اندازه:">
                    <b-button-group v-if="form.fields[activeFieldId].hasOwnProperty('col')">
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
                        {{ element.label }}
                    </div>
                </draggable>
            </div>


        </b-col>
        <b-col cols="9">
            <div class="p-2 alert alert-primary">
                <h3>{{ form.name }}</h3>
                <draggable
                    class="list-group"
                    :list="form.fields"
                    group="fields">


                    <div class="form-group"
                         v-bind:class="{ active: element.style.active }"
                         v-for="(element , index) in form.fields" :key="index"
                         @click="makeActiveField(index)"

                    >
                        <label v-if="element.hasLabel"> <span v-if="element.required">*</span> {{ element.label }}
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

                        <small class="form-text text-muted">{{ element.description }}</small>
                        <button class="delete" @click="deleteField(index)">D</button>
                        <button class="clone" @click="cloneField(element)">C</button>

                    </div>


                </draggable>
            </div>
        </b-col>
    </b-row>
</template>

<script>
import draggable from 'vuedraggable'
import {data} from './data'
import axios from "axios";

export default {
    name: 'form.fields',
    components: {
        draggable
    },
    data() {
        return data
    },
    created() {
    },

    computed: {
        totalPrice: function () {
            return 0;
        },
    },

    methods: {

        storeForm(data) {
            axios.post('/api/ajax/forms', data)
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });

        },

        updateForm(data) {
            axios.put('/api/ajax/forms/'+ data.slug, data)
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });

        },

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


            this.form.fields[this.activeFieldId].options.push(this.newOption);
            this.modalOption = 'table';
            this.newOption = {};
        },


        changeCol(value) {
            this.form.fields[this.activeFieldId].col = value;
        },

        showFieldsInSidebar() {
            this.inActiveFields();
            this.activeFieldId = null;
        },

        inActiveFields() {
            for (let i = 0; i < this.form.fields.length; i++)
                this.form.fields[i].style.active = false;
        },

        makeActiveField(index) {

            this.inActiveFields();

            let newField = Object.assign({}, this.form.fields, {...this.form.fields[index], ...{style: {active: true}}});
            Vue.set(this.form.fields, index, newField);


            this.activeFieldId = index;

        },

        cloneField(value) {

            this.inActiveFields();

            this.form.fields.push(value);

            this.makeActiveField(null, this.form.fields.length - 1)
        },


        deleteField(index) {
            this.form.fields.splice(index, 1);
        },

        deleteOption(item, index, event) {
            console.log(item)
            console.log(index)
            console.log(event)
            this.form.fields[this.activeFieldId].options.splice(index, 1);
        },

        setEditOption(item, index, event) {
            console.log(item)
            console.log(index)
            console.log(event)
            this.form.fields[this.activeFieldId].options.splice(index, 1);
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
    },
    mounted() {
        let url = window.location.href.split('/');
        let i = url.indexOf('forms');
        let slug = url[i + 1];

        axios
            .get('/api/ajax/forms/' + slug)
            .then(response => (this.form = response.data))

    }
}
</script>


<style scoped lang="scss">
@import './style';
</style>

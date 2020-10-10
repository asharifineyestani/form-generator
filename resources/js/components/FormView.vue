<template>
    <div>


        <div v-if="totalPrice > 0 " class="jumbotron">
            <h3 class="display-5">قیمت:
                {{totalPrice}}
                تومان
            </h3>
        </div>


        <div class="form-row">



            <toggle-button :value="true"
                           :labels="{checked: 'VIP', unchecked: null}"/>


            <div v-for="field in fields" :class="'form-group col-md-'+field.col">




                <template v-if="field.type == 'image-cropper'">
                    <label></label>
                    <div class="form-group">
                        <span>لطفا طرح مورد نظر را آپلود نمایید</span>
                        <button @click="toggleShow" class="btn btn-md btn-info" type="button">بارگزاری تصویر</button>
                        <image-crop field="img"

                                    v-model="show"
                                    :noCircle="true"
                                    :noSquare="true"
                                    :width="300"
                                    :height="300"
                                    url="/upload"
                                    img-format="png">

                        </image-crop>
                        <img :src="imgDataUrl">
                    </div>
                </template>

                es

                <template v-if="field.type == 'image-cropper'">
                    <label></label>
                    <div class="form-group">
                        <span>لطفا طرح مورد نظر را آپلود نمایید</span>
                        <button @click="toggleShow" class="btn btn-md btn-info" type="button">بارگزاری تصویر</button>
                        <image-crop field="img"

                                    v-model="show"
                                    :noCircle="true"
                                    :noSquare="true"
                                    :width="300"
                                    :height="300"
                                    url="/upload"
                                    img-format="png">

                        </image-crop>
                        <img :src="imgDataUrl">
                    </div>
                </template>


                <template v-if="field.type == 'select-image'">
                    <label>{{field.title}}</label>
                    <v-select
                        dir="rtl"
                        v-model="form.options[field.id]"
                        label="title"
                        :options="field.options"
                        @input="setSelected"
                    >
                        <template slot="option" slot-scope="option">
                            <img :src="option.src" style="width: 50px;"/>
                            {{ option.title }}
                        </template>
                    </v-select>
                </template>


                <template v-if="field.type == 'multiple-select-image'">
                    <label>{{field.title}}</label>
                    <v-select
                        dir="rtl"
                        v-model="form.options[field.id]"
                        label="title"
                        :options="field.options"
                        @input="setSelected"
                        taggable
                        multiple
                    >
                        <template slot="option" slot-scope="option">
                            <img :src="option.src" style="width: 50px;"/>
                            {{ option.title }}
                        </template>
                    </v-select>
                </template>


                <template v-if="field.type == 'string'">
                    <label>{{field.title}}</label>
                    <input class="form-control" type="text">
                </template>

                <template v-if="field.type == 'select'">
                    <label>{{field.title}}</label>
                    <v-select
                        dir="rtl"
                        v-model="form.options[field.id]"
                        label="title"
                        :options="field.options"
                        @input="setSelected"
                    >
                    </v-select>
                </template>


                <template v-else-if="field.type === 'multiple-select'">
                    <label>{{field.title}}</label>
                    <v-select
                        dir="rtl"
                        v-model="form.options[field.id]"
                        taggable
                        multiple
                        label="title"
                        :options="field.options"
                        @input="setSelected"
                    />
                </template>

            </div>
        </div>
    </div>


</template>

<script>

    import axios from 'axios'


    export default {
        data() {
            return {

                myOptions: {
                    layout: {
                        color: 'black',
                        backgroundColor: 'lightgray',
                        selectedColor: 'white',
                        selectedBackgroundColor: 'green',
                        borderColor: 'black',
                        fontFamily: 'Arial',
                        fontWeight: 'normal',
                        fontWeightSelected: 'bold',
                        squareCorners: false,
                        noBorder: false
                    },
                    size: {
                        fontSize: 14,
                        height: 34,
                        padding: 7,
                        width: 100
                    },
                    items: {
                        delay: .4,
                        preSelected: 'unknown',
                        disabled: false,
                        labels: [
                            {name: 'Off', color: 'white', backgroundColor: 'red'},
                            {name: 'On', color: 'white', backgroundColor: 'green'}
                        ]
                    }
                },
                form: {
                    options: []
                },
                fields: {},
                formOptions: [],
                entityId: window.location.href.split('/')[4],


                show: false,
                params: {
                    token: '123456798',
                    name: 'avatar'
                },
                headers: {
                    smail: '*_~'
                },
                imgDataUrl: '' // the datebase64 url of created image
            }
        },
        created() {
            this.get();
        },

        computed: {
            totalPrice: function () {

                let total_price = 0;

                this.form.options.forEach(function (option) {
                    if (Array.isArray(option))
                        option.forEach(function (item) {
                            total_price += item.price;
                        });
                    else
                        total_price += option.price;
                });

                return total_price;
            }
        },

        methods: {

            get() {
                axios
                    .get('/api/form-generator/forms/' + this.entityId)
                    .then(response => (this.fields = response.data.data.fields))


            },


            testSadegh(value) {


            },


            onSelectImage(value) {
                this.form.options[100] = value;
                this.calculate();
            },

            setSelected() {
            },


            calculate() {

                let self = this;
                let price = this.price;

                this.form.options.forEach(function (item) {
                    // if (self.formOptions.indexOf(item))
                    //     self.formOptions.push(item)

                    let options = Array.isArray(item) ? item : [item];

                    options.forEach(function (option) {
                        price += option.price;
                    })
                });

                this.price += price;
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
            },


            toggleShow() {
                this.show = !this.show;
            },


        }
    }
</script>

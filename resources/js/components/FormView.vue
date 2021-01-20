<template>


    <b-col cols="9">
        <button v-on:click="storeAnswer(computedForm)">answer</button>
        <h3>{{ form.title }}</h3>
        <div class="form-group"
             v-for="(element , index) in form.fields" :key="index"
        >
            <label v-if="element.hasLabel"> <span v-if="element.required">*</span> {{ element.label }}</label>

            <div v-if="element.hidden">Hidden</div>
            <b-col :cols="element.col">
                <v-select
                    dir="rtl"
                    v-if="element.type == 'select-image'"
                    :options="element.options"
                    :multiple="element.multiple"
                    :taggable="element.taggable"
                    :push-tags="element.pushTags"
                    v-model="draft[element.name]"

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
                    v-model="draft[element.name]"
                />


                <b-form-textarea
                    v-if="element.type == 'textarea'"
                    :placeholder="element.placeholder"
                    :disabled="element.disabled"
                    :value="element.value"
                    :rows="element.rows"
                    :max-rows="element.maxRows"
                    v-model="draft[element.name]"
                ></b-form-textarea>


                <b-form-input
                    v-if="element.type == 'number'"
                    :placeholder="element.placeholder"
                    :disabled="element.disabled"
                    :value="element.value"
                    type="number"
                    :min="element.min" :max="element.max"
                    v-model="draft[element.name]"
                ></b-form-input>


                <b-form-input
                    v-if="element.type == 'email'"
                    :placeholder="element.placeholder"
                    :disabled="element.disabled"
                    :value="element.value"
                    type="email"
                    v-model="draft[element.name]"
                ></b-form-input>


                <b-form-input
                    v-if="element.type == 'text'"
                    :placeholder="element.placeholder"
                    :disabled="element.disabled"
                    :value="element.value"
                    :maxlength="element.max"
                    v-model="draft[element.name]"
                ></b-form-input>

            </b-col>

            <small class="form-text text-muted">{{ element.description }}</small>


        </div>
    </b-col>
</template>

<script>

import axios from 'axios'


export default {
    props: {
        slug: String,
    },
    data() {
        return {
            form: {},
            draft : {}
        }
    },
    mounted() {
        axios
            .get('/api/ajax/forms/' + this.slug)
            .then(response => {
                this.form = response.data;
                this.form.form_id = response.data.id

            })

    },

    created() {
        console.log(this.form.id)
    },
    methods: {

        storeAnswer(data) {
            axios.post('/api/ajax/answers', data)
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });

        }
    },

    computed: {
        // a computed getter
        computedForm: function () {
            let answer = {
                body: null,
                form_id: null
            }
            let thisClass = this;

            let fields = this.form.fields;
            fields.forEach(function (element) {
                element.value = thisClass.draft.[element.name];
            });

            answer.form_id = this.form.id;

            answer.body = fields

            return answer;
        }
    }
}
</script>

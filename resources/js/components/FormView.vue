<template>


    <b-col cols="9">
        <button v-on:click="storeAnswer(answer)">answer</button>
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
                    v-model="answer.body.text.value"
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
            answer: {
                form_id: null,
                body: {
                    text: {
                        value: null
                    }
                }
            }
        }
    },
    mounted() {
        axios
            .get('/api/ajax/forms/' + this.slug)
            .then(response => {
                this.form = response.data;
                this.answer.form_id = this.form.id
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
    }
}
</script>

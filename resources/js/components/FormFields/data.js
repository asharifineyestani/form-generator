import {fields} from "./fields";

export const data = {
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

    fields: fields,
    form: {
        title: "form1",
        slug: "form1",
        price: true,
        fields: []
    }

}

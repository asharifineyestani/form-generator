export const fields = [
    {
        label: "انتخاب",
        name: "select",
        type: "select-image",
        price: 0,
        col: 6,
        description: '',
        required: false,
        disabled: false,
        hidden: false,
        hasLabel: true,
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
        label: "سوییچ",
        name: "switch",
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
        hasLabel: true,
        style: {
            active: false
        }
    },
    {
        label: "ایمیل",
        name: "email",
        type: "email",
        icon: "email",
        description: '',
        placeholder: '',
        required: false,
        disabled: false,
        hidden: false,
        hasLabel: true,
        col: 12,
        style: {
            active: false
        }
    },
    {
        label: "متن چند خطی",
        name: "textarea",
        type: "textarea",
        icon: "text",
        rows: 1,
        maxRows: 5,
        description: '',
        placeholder: '',
        required: false,
        disabled: false,
        hidden: false,
        hasLabel: true,
        value: '',
        col: 12,
        style: {
            active: false
        }
    },
    {
        label: "متن",
        name: "text",
        type: "text",
        icon: "text",
        min: 1,
        max: 5,
        description: '',
        placeholder: '',
        required: false,
        disabled: false,
        hidden: false,
        hasLabel: true,
        value: '',
        col: 12,
        style: {
            active: false
        }
    },
    {
        label: "عدد",
        name: "number",
        type: "number",
        icon: "text",
        min: 1,
        max: 5,
        description: '',
        placeholder: '',
        required: false,
        disabled: false,
        hidden: false,
        hasLabel: true,
        value: null,
        col: 12,
        style: {
            active: false
        }
    }
];

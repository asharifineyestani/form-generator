export const fields = [
    {
        name: "انتخاب",
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
    }
];

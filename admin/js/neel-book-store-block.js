const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const { SelectControl } = wp.components;
const { InspectorControls } = wp.blockEditor;
const { withSelect } = wp.data;
const { createElement } = wp.element;

registerBlockType("neel-book-store/book-category", {
  title: __("Book Category", "neel-book-store"),
  icon: "book",
  category: "widgets",
  attributes: {
    category: {
      type: "string",
    },
  },
  edit: withSelect((select) => {
    const { getEntityRecords } = select("core");
    const categories = getEntityRecords("taxonomy", "book_category", {
      per_page: -1,
    });
    return { categories };
  })(({ attributes, setAttributes, categories }) => {
    if (!categories) {
      return "Loading...";
    }

    if (categories.length === 0) {
      return "No categories found";
    }
    console.log(attributes);
    return createElement(
      "div",
      null,
      createElement(
        InspectorControls,
        null,
        createElement(SelectControl, {
          label: __("Select Category", "neel-book-store"),
          value: attributes.category,
          options: categories.map((category) => ({
            label: category.name,
            value: category.slug,
          })),
          onChange: (category) => setAttributes({ category }),
        })
      ),
      createElement(
        "div",
        null,
        attributes.category
          ? `Books from category: ${attributes.category}`
          : "Select a category"
      )
    );
  }),
  save() {
    return null;
  },
});

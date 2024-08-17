$("#snow-editor").each(function (i, el) {
    var el = $(this),
        id = "quilleditor-" + i,
        val = el.val(),
        editor_height = el.data("height") || 160, // Adjusted to accept custom height
        placeholder = el.data("placeholder") || "Enter product description...", // Placeholder text
        div = $("<div/>")
            .attr("id", id)
            .css("min-height", editor_height + "px") // Changed to min-height for auto-grow
            .html(val || placeholder); // Show placeholder if value is empty
    el.addClass("d-none");
    el.parent().append(div);

    var quill = new Quill("#" + id, {
        theme: "snow",
        modules: {
            toolbar: [
                [{ font: [] }, { size: [] }],
                ["bold", "italic", "underline", "strike"],
                [{ color: [] }, { background: [] }],
                [{ script: "super" }, { script: "sub" }],
                [
                    { header: [!1, 1, 2, 3, 4, 5, 6] },
                    "blockquote",
                    "code-block",
                ],
                [
                    { list: "ordered" },
                    { list: "bullet" },
                    { indent: "-1" },
                    { indent: "+1" },
                ],
                ["direction", { align: [] }],
                // ["link", "image", "video"],
                ["clean"],
            ],
        },
    });
    quill.on("text-change", function () {
        el.val(quill.root.innerHTML);
    });

    // Show placeholder when editor is empty
    quill.on("editor-change", function (eventName, ...args) {
        if (eventName === "text-change" && quill.getLength() === 1) {
            quill.clipboard.dangerouslyPasteHTML(0, placeholder);
        }
    });
});

let cachedExplanation = null;

function categoryExplain(name,category , url) {
    if (cachedExplanation) {
        $("#category-explanantion").html(
            `<p class="fs-6">${cachedExplanation}</p>`
        );
        return;
    }
    const message = `Give a short and simple definition of ${name} ${category===name?"":category} in 2-3 sentences.`;
    $.ajax({
        type: "get",
        url: `${url}`,
        data: {
            message: message,
        },
        success: function (response) {
            const content = response.choices[0].message.content;
            cachedExplanation = content;
            $("#category-explanantion").html(`<p class="fs-6">${content}</p>`);
        },
        error: function (xhr, status, error) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                if (errors && errors.message) {
                    toastr.error(errors.message[0], "Validation Error");
                } else {
                    toastr.error("Validation failed.", "Error");
                }
            } else {
                toastr.error(
                    "Something went wrong. Please try again.",
                    "Error"
                );
            }
        },
    });
}

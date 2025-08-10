import Swal from 'sweetalert2';

window.addEventListener("alert", (event) => {
    let data = event.detail;
    Swal.fire({
        title: data.title,
        text: data.text,
        icon: data.type,
        timer: data.timer === false || data.autoClose === false ? undefined : (data.timer ?? 1500),
        background: document.documentElement.classList.contains("dark")
            ? "#1f2937"
            : "#fff",
        color: document.documentElement.classList.contains("dark")
            ? "#fff"
            : "#111827",
    });
});

window.addEventListener("confirmDelete", (event) => {
    const {
        title = "Are you sure?",
        text = "You won't be able to revert this!",
        id = event.detail.id,
        confirmText = "Yes, delete it!",
        cancelText = "Cancel",
    } = event.detail;

    Swal.fire({
        title: title,
        text: text,
        icon: event.detail.type,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        backdrop: `
            rgba(0,0,0,0.4)
            left top
            no-repeat
        `,
        background: document.documentElement.classList.contains("dark")
            ? "#1f2937"
            : "#fff",
        color: document.documentElement.classList.contains("dark")
            ? "#fff"
            : "#111827",
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        if (result.isConfirmed) {
            window.Livewire.dispatch("delete", { id: id });
        }
    });
});

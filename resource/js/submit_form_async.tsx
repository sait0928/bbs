async function submitFormAsync(e, version, setVersion, url) {
    const form = e.currentTarget.closest('form');
    if (!(form instanceof HTMLFormElement)) {
        throw new Error('Cannot find the form element');
    }
    var formData = new FormData(form);
    await fetch(url, {
        method: "POST",
        body: formData
    });
    form.reset();
    setVersion(version + 1);
}
export { submitFormAsync };
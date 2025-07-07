const toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],
    [{ header: 1 }, { header: 2 }],
    [{ list: 'ordered' }, { list: 'bullet' }],
    ['blockquote'],
    ['clean']
];
  
const quill = new Quill('#editor-container', {
    theme: 'snow',
    modules: {
        toolbar: toolbarOptions
    }
});
  
quill.clipboard.addMatcher('IMG', function() {
    return new Delta(); // Import this from 'quill-delta'
});
  
quill.root.addEventListener('drop', function(e) {
    if (e.dataTransfer && e.dataTransfer.files.length) {
        e.preventDefault();
        e.stopPropagation();
    }
});
  
quill.root.addEventListener('paste', function(e) {
    if (e.clipboardData && [...e.clipboardData.items].some(i => i.type.startsWith('image'))) {
        e.preventDefault();
        e.stopPropagation();
    }
});
  
document.querySelector('#quill').addEventListener('submit', function () {
    const html = quill.root.innerHTML.replace(/<img[^>]*>/g, '');
    document.getElementById('content').value = html;
});
  
  
const input = document.getElementById('thumbnail');
const preview = document.getElementById('thumbnail-preview');
const placeholder = document.getElementById('thumbnail-placeholder');
  
input.addEventListener('change', function () {
    const file = this.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
  
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };
  
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');
    }
});
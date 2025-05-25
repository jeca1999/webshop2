document.addEventListener('DOMContentLoaded', function () {
    // Drag and drop image upload for product form
    const dropArea = document.getElementById('drop-area');
    const input = document.getElementById('product-image-input');
    const preview = document.getElementById('preview-image');

    if (dropArea && input && preview) {
        dropArea.addEventListener('click', () => input.click());

        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropArea.classList.add('border-blue-500');
        });

        dropArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropArea.classList.remove('border-blue-500');
        });

        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropArea.classList.remove('border-blue-500');
            if (e.dataTransfer.files.length) {
                input.files = e.dataTransfer.files;
                showPreview(e.dataTransfer.files[0]);
                // Also trigger change event for input so form submission works
                const event = new Event('change', { bubbles: true });
                input.dispatchEvent(event);
            }
        });

        input.addEventListener('change', () => {
            if (input.files.length) {
                showPreview(input.files[0]);
            } else {
                preview.src = '';
                preview.style.display = 'none';
                preview.classList.add('hidden');
            }
        });

        function showPreview(file) {
            if (!file || !file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.style.display = 'block';
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    // --- Product Card Interactivity ---
    const productCards = document.querySelectorAll('.product-card');
    const form = document.getElementById('image-upload-form');
    const nameInput = document.getElementById('product-name');
    const descInput = document.getElementById('product-description');
    const priceInput = document.getElementById('product-price');
    const sizeInput = document.getElementById('product-size');
    const categoryInput = document.getElementById('product-category');
    let lastActiveCard = null;

    // Hide all product-actions when clicking outside any card
    document.addEventListener('click', function (e) {
        const clickedInsideCard = Array.from(productCards).some(card => card.contains(e.target));
        if (!clickedInsideCard) {
            document.querySelectorAll('.product-actions').forEach(a => a.classList.add('hidden'));
            productCards.forEach(card => card.classList.remove('ring', 'ring-blue-400'));
            lastActiveCard = null;
        }
    });

    productCards.forEach(card => {
        card.addEventListener('click', function (e) {
            // Prevent global click from immediately hiding actions
            e.stopPropagation();
            // Hide all action buttons first
            document.querySelectorAll('.product-actions').forEach(a => a.classList.add('hidden'));
            productCards.forEach(c => c.classList.remove('ring', 'ring-blue-400'));
            // Show for this card
            const actions = card.querySelector('.product-actions');
            if (actions) actions.classList.remove('hidden');
            // Highlight card (optional)
            card.classList.add('ring', 'ring-blue-400');
            lastActiveCard = card;
        });
        // Update button logic
        const updateBtn = card.querySelector('.update-product-btn');
        if (updateBtn) {
            updateBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                // Fill form fields
                nameInput.value = card.dataset.productName || '';
                descInput.value = card.dataset.productDescription || '';
                priceInput.value = card.dataset.productPrice || '';
                sizeInput.value = card.dataset.productSize || '';
                categoryInput.value = card.dataset.productCategory || '';
                // Show image preview if available
                if (card.dataset.productImage) {
                    preview.src = card.dataset.productImage;
                    preview.style.display = 'block';
                    preview.classList.remove('hidden');
                } else {
                    preview.src = '';
                    preview.style.display = 'none';
                    preview.classList.add('hidden');
                }
                // Optionally scroll to form
                form.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        }
    });

    // Custom modal logic
    const modal = document.getElementById('edit-product-modal');
    const closeModal = document.getElementById('close-edit-modal');
    const cancelModal = document.getElementById('cancel-edit-modal');
    const editForm = document.getElementById('edit-product-form');
    document.querySelectorAll('.edit-product-link').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const card = this.closest('.product-card');
            document.getElementById('edit-product-id').value = card.dataset.productId;
            document.getElementById('edit-product-name').value = card.dataset.productName;
            document.getElementById('edit-product-description').value = card.dataset.productDescription;
            document.getElementById('edit-product-price').value = card.dataset.productPrice;
            document.getElementById('edit-product-size').value = card.dataset.productSize;
            document.getElementById('edit-product-category').value = card.dataset.productCategory;
            // Set form action
            editForm.action = `/seller/products/${card.dataset.productId}`;
            modal.classList.add('active');
        });
    });
    function hideModal() { modal.classList.remove('active'); }
    closeModal.addEventListener('click', hideModal);
    cancelModal.addEventListener('click', hideModal);
    modal.addEventListener('click', function (e) {
        if (e.target === modal) hideModal();
    });
    document.addEventListener('keydown', function(e) {
        if (modal.classList.contains('active') && e.key === 'Escape') hideModal();
    });

    // --- Subcategory logic for add form ---
    const addCategorySelect = document.getElementById('product-category');
    const addSubcategorySelect = document.getElementById('product-subcategory');
    const subcategories = {
        shop: [
            { value: 'paintings', label: 'Paintings' },
            { value: 'scketches', label: 'Scketches' },
            { value: 'digitl_aarts', label: 'Digital Aarts' }
        ],
        prototype: [
            { value: 'mats', label: 'Mats' },
            { value: 'pins', label: 'Pins' }
        ],
        comissions: []
    };
    function updateAddSubcategories() {
        if (!addCategorySelect || !addSubcategorySelect) return;
        const cat = addCategorySelect.value;
        addSubcategorySelect.innerHTML = '<option value="" disabled selected hidden>Select a subcategory</option>';
        if (subcategories[cat] && subcategories[cat].length > 0) {
            subcategories[cat].forEach(opt => {
                const option = document.createElement('option');
                option.value = opt.value;
                option.textContent = opt.label;
                addSubcategorySelect.appendChild(option);
            });
            addSubcategorySelect.disabled = false;
        } else {
            addSubcategorySelect.disabled = true;
        }
    }
    if (addCategorySelect) {
        addCategorySelect.addEventListener('change', updateAddSubcategories);
        // Ensure a value is selected for initial population
        if (addCategorySelect.value) {
            updateAddSubcategories();
        }
    }

    // --- Subcategory logic for edit modal ---
    const editCategorySelect = document.getElementById('edit-product-category');
    const editSubcategorySelect = document.getElementById('edit-product-subcategory');
    function updateEditSubcategories(selectedValue = '') {
        if (!editCategorySelect || !editSubcategorySelect) return;
        const cat = editCategorySelect.value;
        editSubcategorySelect.innerHTML = '<option value="">Select a subcategory</option>';
        if (subcategories[cat] && subcategories[cat].length > 0) {
            subcategories[cat].forEach(opt => {
                const option = document.createElement('option');
                option.value = opt.value;
                option.textContent = opt.label;
                if (selectedValue && selectedValue === opt.value) option.selected = true;
                editSubcategorySelect.appendChild(option);
            });
            editSubcategorySelect.disabled = false;
        } else {
            editSubcategorySelect.disabled = true;
        }
    }
    if (editCategorySelect) {
        editCategorySelect.addEventListener('change', () => updateEditSubcategories());
        if (editCategorySelect.value) {
            updateEditSubcategories();
        }
    }

    // When opening modal, set subcategory value if present
    document.querySelectorAll('.edit-product-link').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const card = this.closest('.product-card');
            document.getElementById('edit-product-id').value = card.dataset.productId;
            document.getElementById('edit-product-name').value = card.dataset.productName;
            document.getElementById('edit-product-description').value = card.dataset.productDescription;
            document.getElementById('edit-product-price').value = card.dataset.productPrice;
            document.getElementById('edit-product-size').value = card.dataset.productSize;
            document.getElementById('edit-product-category').value = card.dataset.productCategory;
            // Set form action
            editForm.action = `/seller/products/${card.dataset.productId}`;
            modal.classList.add('active');
            if (editSubcategorySelect && card.dataset.productSubcategory) {
                updateEditSubcategories(card.dataset.productSubcategory);
                editSubcategorySelect.value = card.dataset.productSubcategory;
            } else if (editSubcategorySelect) {
                updateEditSubcategories();
            }
        });
    });
});

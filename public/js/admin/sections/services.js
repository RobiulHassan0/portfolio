// Icon injecting in service cards.
document.addEventListener('DOMContentLoaded', () => {
    renderIcons('.service-icon');
});

// Edit Service Modal 

document.addEventListener('click', (e) => {
    const editServiceBtn = e.target.closest('.edit-service-btn');
    if(!editServiceBtn) return;

    document.querySelector('#serviceModalTitle').innerText = 'Edit Service';
    
    const serviceId = editServiceBtn.dataset.id;
    const serviceTitle = editServiceBtn.dataset.title;
    const serviceDesc = editServiceBtn.dataset.description;
    const serviceIcon = editServiceBtn.dataset.icon;
    const serviceCategory = editServiceBtn.dataset.category;
    const serviceStack = editServiceBtn.dataset.stack;
    const serviceFeatures = editServiceBtn.dataset.features;
    const serviceSetup = editServiceBtn.dataset.setup;
    const serviceActive = editServiceBtn.dataset.active;
    const serviceSortOrder = editServiceBtn.dataset.sortOrder;

    const form = document.querySelector("#serviceForm");
    if(!form) return; 
    // if(form) form.reset();

    form.querySelector('[name="service_id"]').value = serviceId;
    form.querySelector('[name="title"]').value = serviceTitle;
    form.querySelector('[name="description"]').value = serviceDesc;
    
    
    form.querySelector('[name="category"]').value = serviceCategory;

    form.querySelector('[name="stack"]').value = serviceStack;

    form.querySelector('[name="features"]').value = serviceFeatures;

    form.querySelector('[name="setup"]').value = serviceSetup;

    form.querySelector('[name="is_active"]').value = serviceActive ;

    form.querySelector('[name="sort_order"]').value = serviceSortOrder ;

    if (window.servicePicker) {
        window.servicePicker.setIcon(serviceIcon || ''); 
    } 
});


// Add New Service Modal

document.querySelector('[data-modal-open="modalService"]')
?.addEventListener('click', () => {
    const form = document.querySelector('#serviceForm');
    if(!form) return;
    if(form) form.reset();

    document.getElementById('serviceModalTitle').innerText = "New Service";

    form.querySelector('[name="service_id"]').value = '';

    if (window.servicePicker) {
        window.servicePicker.setIcon('');
    }

});

// Update  Or Create Service Form Submission with API Call
document.querySelector('[data-demo="Service saved"]')?.addEventListener('submit', async(e) => {
    e.preventDefault();
    
    const serviceId = document.querySelector('[name="service_id"]').value;
    const form = document.querySelector('#serviceForm')
    if(!form){
        return;
    }

    const serviceName = form.querySelector('[name="title"]').value.trim();
    const serviceDesc = form.querySelector('[name="description"]').value.trim();
    const serviceIcon = form.querySelector('[name="icon"]').value.trim();
    const serviceCategory = form.querySelector('[name="category"]').value.trim();
    const serviceStack = form.querySelector('[name="stack"]').value.trim();
    const serviceFeatures = form.querySelector('[name="features"]').value.trim();
    const serviceSetup = form.querySelector('[name="setup"]').value.trim();
    const serviceActive = form.querySelector('[name="is_active"]').value.trim();
    const serviceSortOrder = form.querySelector('[name="sort_order"]').value.trim();

    const payLoad={
        title: serviceName,
        description: serviceDesc,
        icon: serviceIcon,
        category: serviceCategory,
        stack: serviceStack.split(",").map(stackItem => stackItem.trim()).filter(Boolean),
        features: serviceFeatures.split(",").map(featureItem => featureItem.trim()).filter(Boolean),
        setup: serviceSetup.split(",").map(setupItem => setupItem.trim()).filter(Boolean),
        is_active: serviceActive,
        sort_order: serviceSortOrder
    };

    let url = "/api/services";
    let method = 'POST';

    if(serviceId){
        url = `/api/services/${serviceId}`;
        method = 'PUT';
    }

    const token = localStorage.getItem('auth_token');

    try{
        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': "application/json",
                'Authorization': `Bearer ${token}`,
            },
            body: JSON.stringify(payLoad),
        });

        if(!response.ok){
            throw new Error (`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if(data.success){
            alert(data.message || (serviceId 
                ? 'Service Updated Successfully'
                : 'Service Created Successfully')
            );
            location.reload();
            form.reset();
        }else{
            console.error("Validation Or Server Error:", data.error);
            alert(`Action Failed: ${data.message || 'Unknown Error'}`);
        }
    }catch (err){
        console.error('Unexpected Error: ', err);
        alert('An unexpected error occurred.');
    }

});

// Delete Service Modal 

let deleteServiceId = null;

document.addEventListener('click', (e) => {
    const deleteServiceBtn = e.target.closest('.delete-service-btn');
    
    if(!deleteServiceBtn){
        return;
    }else{
        deleteServiceId = deleteServiceBtn.dataset.id; 
    }

    document.querySelector('.modal-head h3').innerText = 'Delete this service?';
});

document.getElementById('confirmDeleteBtn').addEventListener('click', async (e) => {
    if(!deleteServiceId) return;

    const btn = document.getElementById('confirmDeleteBtn');
    btn.disabled = true; 

    const token = localStorage.getItem('auth_token');

    try{
        const response = await fetch(`/api/services/${deleteServiceId}`, {
            method: 'DELETE',
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`
            },
        });
        
        const data = await response.json();

        if(data.success){
            alert(data.message || 'Service deleted successfully.');
            const serviceRow = document.querySelector(`.delete-service-btn[data-id="${deleteServiceId}"]`)?.closest('article');
            if(serviceRow) serviceRow.remove();
        }else{
            alert(data.message || 'Delete failed.');

        }
    }catch( err){
        console.log(err);
        alert('Something went wrong!');
    }finally{
        btn.disabled = false;
        deleteServiceId = null;
    }

});
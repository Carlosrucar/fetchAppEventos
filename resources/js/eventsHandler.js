import { fetchWithConfig } from './utils/fetchUtils';

// Form submission handler
const handleFormSubmit = async (form, isEdit = false) => {
    const formData = new FormData(form);
    const eventId = form.dataset.eventId;
    
    try {
        const url = isEdit ? `/events/${eventId}` : '/events';
        const method = isEdit ? 'PUT' : 'POST';
        
        const response = await fetchWithConfig(url, {
            method: method,
            body: formData
        });
        
        if (response.success) {
            window.location.href = response.redirect;
        }
    } catch (error) {
        alert(error.message);
    }
};

// Delete event handler
const handleDelete = async (eventId) => {
    if (!confirm('¿Estás seguro de eliminar este evento?')) {
        return;
    }
    
    try {
        const response = await fetchWithConfig(`/events/${eventId}`, {
            method: 'DELETE'
        });
        
        if (response.success) {
            window.location.href = '/events';
        }
    } catch (error) {
        alert(error.message);
    }
};

// Initialize event listeners
document.addEventListener('DOMContentLoaded', () => {
    const eventForm = document.querySelector('#eventForm');
    if (eventForm) {
        eventForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const isEdit = eventForm.dataset.eventId !== undefined;
            handleFormSubmit(eventForm, isEdit);
        });
    }

    // Delete buttons
    document.querySelectorAll('.delete-event').forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            handleDelete(button.dataset.eventId);
        });
    });
});
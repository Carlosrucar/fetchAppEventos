import { fetchWithConfig } from './utils/fetchUtils';

export const eventService = {
  async createEvent(formData) {
    return fetchWithConfig('/events', {
      method: 'POST',
      body: formData
    });
  },

  async updateEvent(eventId, formData) {
    return fetchWithConfig(`/events/${eventId}`, {
      method: 'PUT',
      body: formData
    });
  },

  async deleteEvent(eventId) {
    return fetchWithConfig(`/events/${eventId}`, {
      method: 'DELETE'
    });
  }
};

// Event Handlers
document.addEventListener('DOMContentLoaded', () => {
  const eventForm = document.querySelector('#eventForm');
  if (eventForm) {
    eventForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const formData = new FormData(eventForm);
      
      try {
        const response = await eventService.createEvent(formData);
        if (response.success) {
          window.location.href = response.redirect;
        }
      } catch (error) {
        alert(error.message);
      }
    });
  }

  // Delete event handler
  document.querySelectorAll('.delete-event').forEach(button => {
    button.addEventListener('click', async (e) => {
      e.preventDefault();
      if (confirm('¿Estás seguro de eliminar este evento?')) {
        const eventId = button.dataset.eventId;
        try {
          const response = await eventService.deleteEvent(eventId);
          if (response.success) {
            window.location.href = '/events';
          }
        } catch (error) {
          alert(error.message);
        }
      }
    });
  });
});
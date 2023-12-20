// notification.js

// Get the notification icon, sidebar, and close button elements
const notificationIcon = document.getElementById('notificationIcon');
const notificationSidebar = document.getElementById('notificationSidebar');
const closeButton = document.getElementById('closeButton');

// Toggle the notification sidebar on icon click
notificationIcon.addEventListener('click', () => {
  notificationSidebar.classList.toggle('show-sidebar');
});

// Close the notification sidebar on close button click
closeButton.addEventListener('click', () => {
  notificationSidebar.classList.remove('show-sidebar');
});

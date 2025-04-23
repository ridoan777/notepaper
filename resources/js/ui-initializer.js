// Save this as resources/js/ui-reinitializer.js or include directly in your layout

// This function reinitializes all dynamic UI components
function initUIComponents() {
   // Initialize all Flowbite components
   if (typeof initFlowbite === 'function') {
       // Use the built-in initializer if available (newer Flowbite versions)
       initFlowbite();
   } else {
       // Fallback for specific component initialization
       
       // Dropdowns
       const dropdownElements = document.querySelectorAll('[data-dropdown-toggle]');
       if (dropdownElements.length && window.Flowbite?.Dropdown) {
           dropdownElements.forEach(element => {
               new window.Flowbite.Dropdown(element);
           });
       }
       
       // Modals
       const modalElements = document.querySelectorAll('[data-modal-toggle]');
       if (modalElements.length && window.Flowbite?.Modal) {
           modalElements.forEach(element => {
               new window.Flowbite.Modal(element);
           });
       }
       
       // Tooltips
       const tooltipElements = document.querySelectorAll('[data-tooltip-target]');
       if (tooltipElements.length && window.Flowbite?.Tooltip) {
           tooltipElements.forEach(element => {
               new window.Flowbite.Tooltip(element);
           });
       }
       
       // Collapse/Accordion elements
       const collapseElements = document.querySelectorAll('[data-collapse-toggle]');
       if (collapseElements.length && window.Flowbite?.Collapse) {
           collapseElements.forEach(element => {
               new window.Flowbite.Collapse(element);
           });
       }
       
       // Tabs
       const tabElements = document.querySelectorAll('[data-tabs-toggle]');
       if (tabElements.length && window.Flowbite?.Tabs) {
           tabElements.forEach(element => {
               new window.Flowbite.Tabs(element);
           });
       }
   }
   
   // Other UI libraries
   
   // AOS (Animate On Scroll)
   if (typeof AOS !== 'undefined') {
       AOS.refresh();
   }
   
   // Any custom animations
   const animationElements = document.querySelectorAll('.animate-element');
   animationElements.forEach(element => {
       // Reapply custom animations
       element.classList.remove('animation-complete');
       void element.offsetWidth; // Force reflow
       element.classList.add('animate');
   });

    // On page load or when changing themes, best to add inline in `head` to avoid FOUC.
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
}

// Initialize when page first loads
document.addEventListener('DOMContentLoaded', initUIComponents);
// document.addEventListener('DOMContentLoaded', funcction () {
    
// });

// Reinitialize after every Livewire navigation
document.addEventListener('livewire:navigated', initUIComponents);

// For older Livewire versions (v2)
document.addEventListener('livewire:load', initUIComponents);
document.addEventListener('livewire:update', initUIComponents);
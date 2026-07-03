//  async function loadOverViewStats() {
//     try {
//       const token = localStorage.getItem('auth_token');

//       const response = await fetch('/api/overview', {
//         method: 'GET',
//         headers: {
//           'Authorization': 'Bearer ' + token,
//           'X-Requested-With': 'XMLHttpRequest'
//         }
//       });

//       if(!response.ok){
//         throw new Error('Failed to fetch stats');
//       }

//       const data = await response.json();
//       console.log('API Data:', data);
        
//       if(document.querySelector('[data-stat="projects"]')){
//         document.querySelector('[data-stat="projects"]').textContent = data.projects_count ?? 0;
//       }

//       if(document.querySelector('[data-stat="services"]')){
//         document.querySelector('[data-stat="services"]').textContent = data.services_count ?? 0;
//       }

//       if(document.querySelector('[data-stat="skills"]')){
//         document.querySelector('[data-stat="skills"]').textContent = data.skills_count ?? 0;
//       }

//     } catch (err) {
//         console.error('Overview load failed:', err);
//     }
// }

// window.loadOverViewStats = loadOverViewStats;
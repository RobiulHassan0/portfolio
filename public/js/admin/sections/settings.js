async function loadContact() {
    try {
        const token = localStorage.getItem("auth_token");

        const response = await fetch("/api/contacts", {
            method: "GET",
            headers: {
                Authorization: `Bearer ${token}`,
                "X-Requested-With": "XMLHttpRequest",
            },
        });

        if (!response.ok) {
            throw new Error("Failed to load contact data");
        }
        const responseData = await response.json();

        if (responseData && responseData.contact_data) {
            const contact = responseData.contact_data;

            const links = contact.social_links || [];

            //  Contact Section Name
            if (document.querySelector('[name="heading"]')) {
                document.querySelector('[name="heading"]').value =
                    contact.title ?? "";
            }

            //  Contact Section Description
            if (document.querySelector('[name="description"]')) {
                document.querySelector('[name="description"]').value =
                    contact.description ?? "";
            }
            // Contact Section Email
            if (document.querySelector('[name="email"]')) {
                document.querySelector('[name="email"]').value =
                    contact.primary_email ?? "";
            }

            //  Contact Section Social Links
            if (document.querySelector('[name="github"]')) {
                document.querySelector('[name="github"]').value =
                    links.github ?? "";
            }

            if (document.querySelector('[name="linkedin"]')) {
                document.querySelector('[name="linkedin"]').value =
                    links.linkedin ?? "";
            }

            if (document.querySelector('[name="whatsapp"]')) {
                document.querySelector('[name="whatsapp"]').value =
                    links.whatsapp ?? "";
            }
        }
    } catch (err) {
        console.error("Contact data load failed:", err);
    }

    document
        .querySelector(".panel[data-contact-form]")
        ?.addEventListener("submit", async (e) => {
            e.preventDefault();

            const token = localStorage.getItem("auth_token");

            const payload = {
                title: document.querySelector('[name="heading"]').value,
                description: document.querySelector('[name="description"]').value,
                primary_email: document.querySelector('[name="email"]').value,
                social_links: {
                    github: document.querySelector('[name="github"]').value.trim(),
                    linkedin: document.querySelector('[name="linkedin"]').value.trim(),
                    whatsapp: document.querySelector('[name="whatsapp"]').value.trim(),
                }
            };

            try {
                const response = await fetch("/api/contacts", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        Authorization: `Bearer ${token}`,
                    },
                    body: JSON.stringify(payload),
                });

                const data = await response.json();

                if (data.success) {
                    alert(data.message || "Contact saved successfully");
                } else {
                    console.error("Validation Or Server Error:", data.errors);
                    alert(
                        "Failed to save contact: " + (data.message || "Error"),
                    );
                }
            } catch (err) {
                console.error("Request failed", err);
            }
        });

    document.querySelector('.panel[data-demo="Hero saved"]')?.addEventListener('submit', async (e) => {
        e.preventDefault();

        const token = localStorage.getItem('auth_token');

        const stackInput = document.querySelector('[name="stack"]')?.value.trim() || '';
        const stackArray = stackInput ? stackInput.split(',').map( item => item.trim()).filter( item => item !== '') : [];
        
        const isAvailableSelect = document.querySelector('[name="is_available"]')?.value;
        const isAvailableBoolean = isAvailableSelect === 'true' ;

        const payLoad = {
            name: document.querySelector('[name="name"]').value.trim() || '',
            designation: document.querySelector('[name="role"]').value.trim() || '',
            bio: document.querySelector('[name="bio"]').value.trim() || '',

            ctaPrimaryText: document.querySelector('[name="ctaPrimaryText"]').value.trim()  || 'View Projects',
            ctaPrimaryLink: document.querySelector('[name="ctaPrimaryLink"]').value.trim() || '#projects',
            ctaSecondaryText: document.querySelector('[name="ctaSecondaryText"]').value.trim() || 'Contact Me',
            ctaSecondaryLink: document.querySelector('[name="ctaSecondaryLink"]').value.trim() || '#contact',
            
            profile_photo: document.querySelector('[name="image"]').value.trim() || '',
            availability_text: document.querySelector('[name="status"]').value.trim() || '',
            
            resume_url: document.querySelector('[name="resume"]').value.trim() || '',
            focus: document.querySelector('[name="focus"]').value.trim() || '',
            stack: stackArray,
            is_available: isAvailableBoolean,
        }

        try{
            const response = await fetch('/api/profile', {
                method: 'POST', 
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    Authorization: `Bearer ${token}`,
                },
                body: JSON.stringify(payLoad),
            });

            const data = await response.json();

            if(data.success){
                alert(data.message || 'Profile saved successfully');
            }else{
                console.error('Validation Or Server Error:', data.errors);
                alert('Failed to save profile: ' + (data.message || 'Error'));
            }
        }catch(err){
            console.error('Request failed', err);
        }
    });
}

window.loadContact = loadContact;

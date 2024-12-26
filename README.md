# Laraveled.com Project Plan

## **Core Concept**
- **Purpose**: A directory for showcasing projects built on Laravel, with user profiles and social features to foster interaction.
- **Tagline**: "Discover, Share, and Celebrate Laravel Creations!"
- **Hook**: "Get Laraveled!" - A fun and celebratory vibe with confetti animations.

---

## **Key Features**

### **User Flow**
1. **Guest View**:
    - Browse directory of projects (with filters like category, tags, popularity).
    - View project details (limited details visible for guests).
2. **User Registration/Login**:
    - Simplified email-based registration or OAuth (GitHub, Google, etc.).
3. **Submit a Project**:
    - Add project title, URL, description, tags, and a thumbnail image.
    - Optional: Add a link to GitHub repository.
4. **Celebrate Submissions**:
    - Confetti animation with "You just got Laraveled!" on submission success.
5. **Project Details Page**:
    - Display project info, links, and optional screenshots.
    - Comments/likes from other users.
6. **Dashboard for Users**:
    - Manage their submissions, edit projects, and see engagement metrics.

---

### **Community Engagement**
- **Gamification**:
    - Badges for contributions (e.g., "First Project", "Top Contributor").
    - Leaderboard for most active users or most popular projects.
- **Follow Projects**:
    - Users can bookmark projects to their profile.
- **Social Sharing**:
    - Generate a custom shareable image for each project ("Featured on Laraveled.com").

---

## **Tech Stack**
- **Backend**: Laravel 11.
- **Frontend**: TailwindCSS for styling, Livewire for interactivity.
- **Database**: MySQL or PostgreSQL or SQlite.
- **Authentication**: Laravel Breeze or Jetstream (minimal setup with Tailwind).
- **Search**: Laravel Scout with Algolia or Meilisearch for fast project searching.

---

## **Design Ideas**
- **Theme**: Playful and modern with a focus on gradients and subtle animations.
- **Homepage**:
    - Hero section: “Discover Laravel Creations” + search bar + call-to-action to submit.
    - Featured Projects Carousel.
- **User Dashboard**:
    - A clean grid layout to show project cards with an "Add New Project" button.
- **Project Cards**:
    - Include project thumbnail, title, short description, and submission stats (views/likes).

---

## **Development Roadmap**

### **Phase 1: MVP**
- User registration/login.
- Submit and view projects.
- Confetti animation.
- Basic project filtering.

### **Phase 2: Community Features**
- Comments, likes, and badges.
- Social sharing for projects.
- Advanced search and filtering.

### **Phase 3: Monetization**
- Featured project placements.
- Premium accounts for additional analytics.
- Sponsored project showcases.

---

## **Radical Ideas**
- **Live Collaboration**:
    - Allow users to collaborate on projects by linking profiles.
- **API Integration**:
    - Offer an API to embed "Featured on Laraveled.com" badges on websites.
- **Real-Time Stats**:
    - Showcase live stats like "Projects Submitted This Week."

---

What do you think? Let’s start wireframing or building the MVP!

// import { Component } from '@angular/core';

// @Component({
//   selector: 'app-navbar',
//   imports: [],
//   templateUrl: './navbar.html',
//   styleUrl: './navbar.css',
// })
// export class Navbar {}
import { Component, inject, signal } from '@angular/core';
import { News } from '../../services/news';

@Component({
  selector: 'app-navbar',
  standalone: true,
  templateUrl: './navbar.html',
  styleUrl: './navbar.css',
})
export class Navbar {
  private newsService = inject(News);
  menuOpen = signal(false);

  categories = [
    { section: 'NEWS', items: [{ label: 'Latest', slug: null }] },
    {
      section: 'VIEWS',
      items: [
        { label: 'Opinions', slug: 'columns' },
        { label: 'Letters', slug: 'letters' },
        { label: 'Yoursay', slug: 'yoursay' },
      ],
    },
  ];

  toggleMenu(): void {
    this.menuOpen.update((open) => !open);
  }

  selectCategory(slug: string | null): void {
    this.newsService.selectedCategory.set(slug);
    this.menuOpen.set(false);
  }
}

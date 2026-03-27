function initializeInfoBlockFilters() {
  console.log('--- Inicjalizacja filtrów ---');
  const infoBlocks = document.querySelectorAll('.b-info');

  if (infoBlocks.length === 0) {
    console.log('Nie znaleziono żadnych bloków `.b-info`.');
    return;
  }

  infoBlocks.forEach((block, index) => {
    console.log(`[Blok ${index + 1}] Przetwarzanie...`);
    const filterContainer = block.querySelector('[id^="table-filters-"]');
    const tableBody = block.querySelector('.__tbody');

    if (!filterContainer || !tableBody) {
      console.log(`[Blok ${index + 1}] Pominięto - brak kontenera filtrów lub tbody.`);
      return;
    }

    // Pobieranie elementów filtrujących
    const dzialkaOd = filterContainer.querySelector('#filter-dzialka-od');
    const dzialkaDo = filterContainer.querySelector('#filter-dzialka-do');
    const statusCheckboxes = filterContainer.querySelectorAll('.filter-status-checkbox');
    const typDomuCheckboxes = filterContainer.querySelectorAll('.filter-typ-domu-checkbox');
    const resetButton = filterContainer.querySelector('#filter-reset-button');
    const tableRows = tableBody.querySelectorAll('.__tr');

    if (!dzialkaOd || !dzialkaDo || !resetButton || tableRows.length === 0) {
      console.log(`[Blok ${index + 1}] Pominięto - brak kluczowych elementów (input, button, rows).`);
      return;
    }

    function filterTable() {
      console.log(`--- Uruchomiono filtrowanie w Bloku ${index + 1} ---`);

      const dzialkaOdVal = parseFloat(dzialkaOd.value) || 0;
      const dzialkaDoVal = parseFloat(dzialkaDo.value) || Infinity;

      const selectedStatuses = Array.from(statusCheckboxes)
        .filter(checkbox => checkbox.checked)
        .map(checkbox => checkbox.value);

      const selectedTypyDomu = Array.from(typDomuCheckboxes)
        .filter(checkbox => checkbox.checked)
        .map(checkbox => checkbox.value);

      console.log('Zakres działki:', dzialkaOdVal, '-', dzialkaDoVal);
      console.log('Wybrane statusy:', selectedStatuses);
      console.log('Wybrane typy domu:', selectedTypyDomu);

      tableRows.forEach(row => {
        const rowDzialka = parseFloat(row.dataset.dzialka) || 0;
        const rowStatus = row.dataset.status;
        const rowTypDomu = row.dataset.typDomu;

        const dzialkaMatch = rowDzialka >= dzialkaOdVal && rowDzialka <= dzialkaDoVal;
        const statusMatch = selectedStatuses.length === 0 || selectedStatuses.includes(rowStatus);
        const typDomuMatch = selectedTypyDomu.length === 0 || selectedTypyDomu.includes(rowTypDomu);

        if (dzialkaMatch && statusMatch && typDomuMatch) {
          row.style.display = 'grid';
        } else {
          row.style.display = 'none';
        }
      });
    }

    function resetFilters() {
      dzialkaOd.value = '';
      dzialkaDo.value = '';
      statusCheckboxes.forEach(checkbox => checkbox.checked = false);
      typDomuCheckboxes.forEach(checkbox => checkbox.checked = false);
      console.log('Filtry zresetowane.');
      filterTable();
    }

    // --- GŁÓWNA ZMIANA: Uproszczone listenery zdarzeń ---
    filterContainer.addEventListener('input', filterTable); // Dla pól tekstowych
    filterContainer.addEventListener('change', filterTable); // Dla checkboxów

    if (resetButton) {
      resetButton.addEventListener('click', resetFilters);
    }

    // Inicjalne filtrowanie
    filterTable();
  });
}

// Uruchomienie
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeInfoBlockFilters);
} else {
  initializeInfoBlockFilters();
}

// Wsparcie dla edytora ACF
if (window.acf) {
  window.acf.addAction('render_block_preview', initializeInfoBlockFilters);
}
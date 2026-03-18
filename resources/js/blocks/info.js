function initializeInfoBlockFilters() {
  console.log('--- Inicjalizacja filtróws ---');
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

    const dzialkaOd = filterContainer.querySelector('input[placeholder="od"]');
    const dzialkaDo = filterContainer.querySelector('input[placeholder="do"]');
    const statusCheckboxes = filterContainer.querySelectorAll('.filter-status-checkbox');
    const resetButton = filterContainer.querySelector('[id^="filter-reset-button"]');
    const tableRows = tableBody.querySelectorAll('tr');
    
    console.log(`[Blok ${index + 1}] Znaleziono ${tableRows.length} wierszy do filtrowania.`);

    function filterTable() {
      console.log(`--- Uruchomiono filtrowanie w Bloku ${index + 1} ---`);
      
      const dzialkaOdVal = parseFloat(dzialkaOd.value) || 0;
      const dzialkaDoVal = parseFloat(dzialkaDo.value) || Infinity;
      
      const selectedStatuses = Array.from(statusCheckboxes)
        .filter(checkbox => checkbox.checked)
        .map(checkbox => checkbox.value);

      console.log('Zakres działki:', dzialkaOdVal, '-', dzialkaDoVal);
      console.log('Wybrane statusy:', selectedStatuses);

      tableRows.forEach(row => {
        const rowDzialka = parseFloat(row.dataset.dzialka) || 0;
        const rowStatus = row.dataset.status;

        const dzialkaMatch = rowDzialka >= dzialkaOdVal && rowDzialka <= dzialkaDoVal;
        const statusMatch = selectedStatuses.length === 0 || selectedStatuses.includes(rowStatus);
        
        // Logika wyświetlania
        if (dzialkaMatch && statusMatch) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }

    function resetFilters() {
      dzialkaOd.value = '';
      dzialkaDo.value = '';
      statusCheckboxes.forEach(checkbox => checkbox.checked = false);
      console.log('Filtry zresetowane.');
      filterTable();
    }
    
    // Zdarzenia
    filterContainer.addEventListener('change', event => {
        if (event.target.classList.contains('filter-status-checkbox')) {
            filterTable();
        }
    });
    filterContainer.addEventListener('input', event => {
        if (event.target.matches('input[placeholder="od"]') || event.target.matches('input[placeholder="do"]')) {
            filterTable();
        }
    });
    if (resetButton) {
        resetButton.addEventListener('click', resetFilters);
    }
  });
}

// Uruchomienie
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeInfoBlockFilters);
} else {
  initializeInfoBlockFilters();
}

if (window.acf) {
  window.acf.addAction('render_block_preview', initializeInfoBlockFilters);
}
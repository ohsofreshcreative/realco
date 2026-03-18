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

    // Używamy ID, które są w HTML, dla pewności
    const dzialkaOd = filterContainer.querySelector('#filter-dzialka-od');
    const dzialkaDo = filterContainer.querySelector('#filter-dzialka-do');
    const statusCheckboxes = filterContainer.querySelectorAll('.filter-status-checkbox');
    const resetButton = filterContainer.querySelector('#filter-reset-button');
    
    // --- KLUCZOWA ZMIANA: Szukamy div'ów z klasą .__tr, a nie znaczników <tr> ---
    const tableRows = tableBody.querySelectorAll('.__tr');
    
    console.log(`[Blok ${index + 1}] Znaleziono ${tableRows.length} wierszy (.--tr) do filtrowania.`);

    // Sprawdzenie, czy wszystkie elementy formularza istnieją
    if (!dzialkaOd || !dzialkaDo || !resetButton) {
        console.log(`[Blok ${index + 1}] Pominięto - brak jednego z kluczowych elementów filtrujących (input/button).`);
        return;
    }

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
        
        if (dzialkaMatch && statusMatch) {
          // --- ZMIANA: Przywracamy styl 'grid', który jest używany w CSS ---
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
        if (event.target.id === 'filter-dzialka-od' || event.target.id === 'filter-dzialka-do') {
            filterTable();
        }
    });
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
function singleSelect(data, idKey, nameKey, selectedId = null) {
    return {
        open: false,
        search: '',
        selected: null,
        items: data,
        idKey,
        nameKey,
        filteredItems() {
            if (this.search === '') return this.items;
            return this.items.filter(i =>
                i[this.nameKey].toLowerCase().includes(this.search.toLowerCase())
            );
        },
        choose(item) {
            this.selected = item;
            this.search = item[this.nameKey];
            this.open = false;
        },
        clear() {
            this.selected = null;
            this.search = '';
        },
        init() {
            if (selectedId !== null) {
                this.selected = this.items.find(i => i[this.idKey] === selectedId) || null;
                if (this.selected) {
                    this.search = this.selected[this.nameKey];
                }
            }
        }
    };
}

function multiSelect(data, idKey, nameKey, selectedIds = []) {
    return {
        open: false,
        search: '',
        selected: [],
        items: data,
        idKey: idKey,
        nameKey: nameKey,
        selectedIds: selectedIds,
        filteredItems() {
            if (this.search === '') return this.items;
            return this.items.filter(i =>
                i[this.nameKey].toLowerCase().includes(this.search.toLowerCase())
            );
        },
        toggle(item) {
            if (this.isSelected(item)) {
                this.selected = this.selected.filter(s => s[this.idKey] !== item[this.idKey]);
            } else {
                this.selected.push(item);
            }
        },
        isSelected(item) {
            return this.selected.some(s => s[this.idKey] === item[this.idKey]);
        },
        remove(item) {
            this.selected = this.selected.filter(s => s[this.idKey] !== item[this.idKey]);
        },
        init() {
            if (this.selectedIds && this.selectedIds.length > 0) {
                const selectedIdInts = this.selectedIds.map(id => parseInt(id));
                this.selected = this.items.filter(item =>
                    selectedIdInts.includes(item[this.idKey])
                );
            }
        }
    };
}

function citySelect(cities, selectedCityId = null) {
    return {
        open: false,
        search: '',
        selected: null,
        cities: cities,
        selectedCityId: selectedCityId,
        get filtered() {
            if (this.search === '') return [];
            return this.cities.filter(c =>
                c.city.toLowerCase().includes(this.search.toLowerCase())
            );
        },
        select(city) {
            this.search = city.city;
            this.selected = city;
            this.open = false;
        },
        updateSelection() {
            if (!this.selected || this.search !== this.selected.city) {
                this.selected = null;
            }
        },
        init() {
            if (selectedCityId !== null) {
                this.selected = this.cities.find(c => c.city_pk === selectedCityId) || null;
                if (this.selected) {
                    this.search = this.selected.city;
                }
            }
        }
    }
}

window.singleSelect = singleSelect;
window.multiSelect = multiSelect;
window.citySelect = citySelect;

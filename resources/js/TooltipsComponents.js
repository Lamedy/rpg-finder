
function tooltipComponent() {
    return {
        open: false,
        isNearRightEdge: false,

        checkEdge() {
            if (!this.$refs.button) return;
            const rect = this.$refs.button.getBoundingClientRect();
            this.isNearRightEdge = (window.innerWidth - rect.right) < 200;
        },

        toggle() {
            this.open = !this.open;
            if (this.open) {
                this.checkEdge();
            }
        }
    }
}

window.tooltipComponent = tooltipComponent;

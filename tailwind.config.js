module.exports = {
  content: ["./**/*.php", "./src/**/*.js", "./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {
      dropShadow: {
        "ca-text": "0 1 1 rgba(0,0,0, 0.7)"
      },
      scale: {
        md: "1.07",
        lg: "1.15"
      },
      colors: {
        bbj500: "#35546e",
        bbjSoft: "#4D6D88",
        bbjHard: "2D4B65",
        second500: "#FFBF0F",
        secondSoft: "#ffd970",
        secondHard: "#FA910A",
        textColor: ""
      },
      fontFamily: {
        sans: ["Roboto", "sans-serif"],
        osw: ["Oswald", "sans-serif"]
      }
    }
  },
  plugins: [require("@tailwindcss/typography"), require("flowbite/plugin")]
};
